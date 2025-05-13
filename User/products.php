<?php
    include "../oop.php";

    $oop = new login_page();

    $fetch_product = $oop->fetch_product();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sweet Indulgences</title>
	<link rel="stylesheet" type="text/css" href="..\style\style.css">
    <link rel="stylesheet" type="text/css" href="..\style\bootstrap.css">
    <link rel="shortcut icon" href="..\logo\logo.png" type="image/x-icon">
</head>
<body>
	<header class="nav">
        <img class="logo" style="width: 90px;" src="..\logo\logo.png">
        <nav>
            <ul>
                <li><h1><a href="../index.php">Home</a></li>
                <li><h1><a href="#">Products</a></li>
                <li><h1><a href="contactUs.php">Inquiry</a></li>
                <li class="profile-nav"><h1><a href="cart.php"><img style="width: 70px; " src="../logo/shopping-cart.png" class="profile-image"></a></li>
            </ul>
        </nav>
    </header>
    <section>
        <div class="specials">
            <div class="special-lists">
            	<h1>Products</h1>
                <form method="POST" enctype="multipart/form-data">
                <ul>
                    <?php
                    while ($row = mysqli_fetch_array($fetch_product)) {
                    ?>
                    <li>
                        <img src="..\products\<?php echo $row['product_pic']; ?>">
                        <h3><?php echo $row['product_name'] ?></h3>
                        <h4>₱<?php echo $row['price'] ?> </h4>
                        <a class="buynow" href="../buynow/product.php?ID=<?php echo $row['Id']; ?>" >Buy</a>
                    </li>
                    <?php
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