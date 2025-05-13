<?php
session_start();
include "../oop.php";

$oop = new login_page();
$fetch_product = $oop->fetch_product();
$fetchrecord = $oop->fetch_all_records();
$test = array();
$uniqueIds = array();

while ($row = mysqli_fetch_array($fetchrecord)) {
    $productId = $row["Id"];
    $bought = $row["items"];
    $date = $row['Date'];

    // Check if the Id is already added
    $key = array_search($productId, $uniqueIds);

    if ($key !== false) {
        // If ID already exists, add the items to the existing entry
        $test[$key]["y"] += $bought;
    } else {
        // If ID doesn't exist, add a new entry
        $uniqueIds[] = $productId;
        $test[] = array("label" => $row["product_name"], "y" => $bought);
    }
}

usort($test, function ($a, $b) {
    return $a['y'] - $b['y'];
});

// Extract the most bought product
$mostBought = end($test);

if (!isset($_SESSION['USERNAME'])) {
    header("location:../admin.php");
}
if (isset($_POST['delete'])) {
    if (isset($_POST['selectedProducts']) && is_array($_POST['selectedProducts'])) {
        foreach ($_POST['selectedProducts'] as $selectedProductId) {
            $delete_product = $oop->delete_data($selectedProductId);
        }
        header("location: admin.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="..\style\admin2.css">
    <link rel="shortcut icon" href="..\logo\logo.png" type="image/x-icon">
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light1",
                title: {
                    text: "Most Bought (<?php echo $date; ?>)"
                },
                axisY: {
                    title: "Quantity"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.## items",
                    dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
    <style>
        body {
            background-image: url("../logo/back.png");
            background-color: #FFEAD0;
            background-size: 300px;
        }
    </style>
    <script>
        function toggleSelectAll(source) {
            // Get all checkboxes with name "selectedProducts"
            var checkboxes = document.getElementsByName('selectedProducts[]');
            // Loop through each checkbox and set its checked property to the source checkbox's checked property
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
</head>

<body>

    </head>

    <body>
        <header class="nav">
            <img class="logo" style="width: 90px;" src="..\logo\logo.png">
            <nav>
                <ul>
                    <li>
                        <h1><a href="#">Home</a>
                    </li>
                    <li>
                        <h1><a href="Order.php">Order List</a>
                    </li>
                    <li>
                        <h1><a href="records.php">Records</a>
                    </li>
                    <li>
                        <h1><a href="message.php">Messages</a>
                    </li>
                    <li>
                        <h1><a href="..\logout.php">Log Out</a>
                    </li>
                </ul>
            </nav>
        </header>
        <main>

        </main>
        <center style="margin: auto;">
            <div class="contain">
                <div class="dashboard">
                    <div class="specials ">
                        <button name="add" class="add" onclick="document.location='add.php'" style="margin:auto;">Add Product</button>
                        <form method="POST">

                            <button name="delete" class="add">Delete Selected</button>
                            <div class="special-lists order-container">
                                <input type="checkbox" id="selectAllCheckbox" onclick="toggleSelectAll(this)">
                                <label for="selectAllCheckbox">Select All</label>
                                <ul>
                                    <?php
                                    if (mysqli_num_rows($fetch_product) < 1) {
                                        echo "<center><h1>NO PRODUCTS FOUND</h1></center>";
                                    } else {
                                        while ($row = mysqli_fetch_array($fetch_product)) {
                                            $id = $row['Id'];
                                    ?>

                                            <li>
                                                <input type="checkbox" name="selectedProducts[]" value="<?php echo $id; ?>">
                                                <div class="cart">
                                                    <img src="..\products\<?php echo $row['product_pic']; ?>">

                                                    <h4>Price: <?php echo $row['price'] ?></h4>
                                                    <b>Name:</b>
                                                    <p><?php echo $row['product_name'] ?></p>
                                                    <label for="message"><b>Message: </b></label>
                                                    <textarea name="message" readonly><?php echo $row['description'] ?></textarea>
                                                    <a href="change.php?ID=<?php echo $id ?>" name="change" class="add">Change</a>
                                                    <?php echo $id; ?>
                                                </div>
                                            </li>
                                    <?php
                                        }
                                    }

                                    ?>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="chart">
                    <div class="chart-container">
                        <div id="chartContainer" style="height: 450px; width: 100%; color:aqua;"></div>
                        <script src="../../../canvasjs-chart/canvasjs.min.js"></script>
                    </div>
                </div>
            </div>
        </center>
        <footer>
            <p>&copy; 2023 CDV Developer</p>
        </footer>
    </body>

</html>