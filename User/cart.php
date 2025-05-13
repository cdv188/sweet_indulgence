<?php
    include "../oop.php";

    $oop = new login_page();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" type="text/css" href="..\style\admin.css">
    <link rel="stylesheet" type="text/css" href="..\style\bootstrap.css">
    <link rel="shortcut icon" href="..\logo\logo.png" type="image/x-icon">
</head>
<body>
        <?php
            $fetch_order = $oop->fetch_order();
        ?>
    <header class="nav">
        <img class="logo" style="width: 90px;" src="..\logo\logo.png">
        <nav>
            <ul>
                <li><h1><a href="../index.php">Home</a></li>
                <li><h1><a href="products.php">Products</a></li>
                <li><h1><a href="contactUs.php">Inquiry</a></li>
                <li class="profile-nav"><h1><a href="#"><img style="width: 70px; " src="../logo/shopping-cart.png" class="profile-image"></a></li>
            </ul>
        </nav>
    </header>
    <main>
        
    </main>
    <section>
        <form method="POST" enctype="multipart/form-data">
            <div class="specials">
                 
                <div class="special-lists">
                    <ul>
                        <?php
                         $totalSummaryPrice=0;
                          $userOrdersFound = false;
                        while ($row = mysqli_fetch_array($fetch_order)) {
                                $userOrdersFound = true;

                                $id = $row['Id'];
                                $price = $row['price'];
                                $items = $row['Items'];
                                $total = number_format($price * $items, 2);
                                $totalSummaryPrice += number_format((float)$total,2);
                        ?>

                        <li>
                                <div class="cart">
                                <img src="..\products\<?php echo $row['product_img']; ?>">
                                
                                <p>Price: <h4><?php echo $total; ?></h4></p>
                                <p>Product: <h3><?php echo $row['product_name'] ?>&nbsp</h3></p>
                                <p>Items: <h3><?php echo $row['Items'];?> </h3></p>
                                <a href="change-order.php?ID=<?php echo $row['Id']; ?>" class="add">Change</a>
                            </div>
                            
                        </li>
                        
                        <?php
                            }
                        if (!$userOrdersFound) {
                        echo "<center><h1>NO ORDERS FOUND</h1></center>";
                        }
                        ?>
                         <li style="width: 150px; margin: 15px auto ;">
                            <p>Total <h2 style="color: red;">₱<?php echo number_format($totalSummaryPrice,2); ?></h2></p>
                        </li>
                         </form>
                        <li style="width:200px; margin: auto;">
                            <a href="products.php" class="add">Buy More</a>
                            <a href="checkout.php" class="add">Check Out</a>
                        </li>
                    </ul>
                </div>
            </div>
       
    </section>
    <footer>
        <p>&copy; 2023 CDV Developer</p>
    </footer>
</body>
</html>