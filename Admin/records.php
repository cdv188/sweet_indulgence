<?php
    session_start();
    include "../oop.php";

    $oop = new login_page();
    $fetch_order = $oop->fetch_records();


    if(!isset($_SESSION['USERNAME'])){
        header("location:../admin.php");
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="..\style\admin.css">
    <link rel="shortcut icon" href="..\logo\logo.png" type="image/x-icon">
    <style type="text/css">
        body{
            background-image: url("../logo/back.png");
            background-color: #FFEAD0;
            background-size: 300px;
        }
        center{
            color: white;
            font-size: 50px;
        }
        section{
            margin: auto;
        }
        tbody{
            background-color: #606c88;
            border-radius: 10px;
            color: white;
            font-size: 15px;
        }
        table,th,td{
            border-radius: 5px;
        }
        tr th{
            background-color: #DD3F2F;
            text-align: center;
            padding: 15px;
             max-width: 400px
        }
        tr td{
            background-color: #444;
            text-align: center;
            padding: 15px;
            max-width: 400px
        }
        .message {
            max-width: 400px; /* Adjust this width as needed */
            word-wrap: break-word;
        }
        .menu-container {
          color: white;
          position: relative;
          text-decoration: none;
          font-size: 20px;
          background-color: #DD3F2F;
          padding: 5px;
          border-radius: 10px;
        }

        .menu-container::before {
          content: '';
          position: absolute;
          width: 100%;
          height: 4px;
          border-radius: 4px;
          background-color: white;
          bottom: 0;
          left: 0;
          transform-origin: right;
          transform: scaleX(0);
          transition: transform .3s ease-in-out;
        }

        .menu-container:hover::before {
          transform-origin: left;
          transform: scaleX(1);
        }

        ::-webkit-calendar-picker-indicator {
          background-color: #ffffff;
          padding: 5px;
          cursor: pointer;
          border-radius: 3px;

        }
         table {
            margin: auto;
        }
        center{
            color: black;
        }
    </style>
</head>
<body>
    <header class="nav">
        <img class="logo"style="width: 90px;" src="..\logo\logo.png">
        <nav>
            <ul>
                <li><h1><a href="admin.php">Home</a></li>
                <li><h1><a href="Order.php">Order List</a></li>
                <li><h1><a href="records.php">Records</a></li>
                <li><h1><a href="message.php">Messages</a></li>
                <li><h1><a href="..\logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <section >
            <table>
                <?php
                    $fetch = $oop->fetch_data();

                    if (mysqli_num_rows($fetch_order)<1){
                        echo "<center><h1>NO RECORDS FOUND</h1></center>";
                    }else{
                    echo "<tr>
                            <th>ID</th>
                            <th>PRODUCT</th>
                            <th>ITEMS</th>
                            <th>PRICE</th>
                            <th>TOTAL</th>
                            <th>DATE</th>
                            <th>ACTION</th>
                        </tr";
                    while($row = mysqli_fetch_array($fetch_order)){
                        $id = $row['Id'];
                        $price = $row['price'];
                        $items = $row['items'];
                        $total = $price * $items;
                ?>
                <tr>
                    <td>
                        <?php echo $row['Id']; ?>             
                    </td>
                    <td>
                        <?php echo $row['product_name']; ?>  
                    </td>
                     <td class="message">
                        <?php echo $row['price']; ?>     
                    </td>
                    <td>
                        <?php echo $row['items']; ?>  
                    </td>
                    <td>
                        <?php echo number_format($total, 2); ?>  
                    </td>
                    <td>
                        <?php echo $row['Date']; ?>  
                    </td>
                    <td>
                    <a href="delete_order.php?ID=<?php echo $id ?>" class="add">Delete</a>
                    </td>
                <?php
                    }
                }
                ?>
                </tr>
            </table>
            
            <form method="POST" enctype="multipart/form-data">
                <button class="add" type="button" onclick="complete()" style="margin: auto;">Download Records</button>
                <a href="deleteall.php"  style="width: 120px;" class="add">Delete All Records</a>
            </form> 
    </section>
    </main>
   
    <script>
        function complete(){
            var xhr = new XMLHttpRequest();
        xhr.open('POST', 'download_records.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Successful response, handle as needed
                    console.log(xhr.responseText);
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    // Handle error
                    console.error('AJAX request failed');
                }
            }
        };

        var selectedProducts = document.querySelectorAll('.order-list.selected');
        var productIds = Array.from(selectedProducts).map(function (product) {
            return product.dataset.productId; // assuming data-product-id attribute is set
        });
        xhr.send('action=download_records&selectedProducts=' + productIds.join(','));
        // Open the link in a new tab
        window.open('download_records.php', '_blank');

    }
    </script>
    <footer>
        <p>&copy; 2023 CDV Developer</p>
    </footer>
</body>
</html>