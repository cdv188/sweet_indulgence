<?php
    include "oop.php";

    $oop = new login_page();
    $fetch_product = $oop->fetch_product();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sweet Indulgences</title>
    <link rel="stylesheet" type="text/css" href="style\style.css">
    <link rel="stylesheet" type="text/css" href="style\bootstrap.css">
    <link rel="shortcut icon" href="logo\logo.png" type="image/x-icon">
</head>
<body>
    <header class="nav">
        <img class="logo" style="width: 90px;" src="logo\logo.png">
        <nav>
            <ul>
                <li><h1><a href="#">Home</a></li>
                <li><h1><a href="user/products.php">Products</a></li>
                <li><h1><a href="user/contactUs.php">Inquiry</a></li>
                <li class="profile-nav"><h1><a href="user/cart.php"><img style="width: 70px; " src="logo/shopping-cart.png" class="profile-image"></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="showcase">
            <div class="showcase-mess">
                <h1>Yummy Freshly bake delicacies delivered to you!</h1>
                <p>When you walk by a bakery, you can often smell the delicious aroma of fresh bread or sweet pastries. This smell can make you feel hungry even if you just ate!</p>
                <button class="orderNow" onclick="document.location='user/products.php'">ORDER NOW</button>
            </div>
            <div class="showcase-img" >
                <img src="logo\back_nav2.png">
            </div>
        </div>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100"><path fill="#FFEAD0" fill-opacity="1" d="M0,64L80,74.7C160,85,320,107,480,101.3C640,96,800,64,960,42.7C1120,21,1280,11,1360,5.3L1440,0L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path></svg>
        
    </main>
    <section>
        <div class="specials">
            <h1>This Week's Specials</h1>
            <p>Try our most popular bread and taste the difference!</p>
            <div class="special-lists">
            <form method="POST" enctype="multipart/form-data">
                <ul>
                    <?php
                    $counter = 0;
                    while ($row = mysqli_fetch_array($fetch_product)) {
                    ?>
                    <li>
                        <img src="products\<?php echo $row['product_pic']; ?>">
                        <h3><?php echo $row['product_name'] ?></h3>
                        <h4><?php echo $row['price'] ?> ₱</h4>
                        <a class="buynow" href="buynow/product.php?ID=<?php echo $row['Id']; ?>" >Buy</a>
                    </li>
                    <?php
                     $counter++;
                     if ($counter === 4) {
                        break;
                    }
                    }
                    ?>
                </ul>
            </form>
            </div>
        </div>
    </section>
    <footer>
        <p>&copy; 2023 CDV Developer</p>
    </footer>
</body>
</html>
