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
    <link rel="stylesheet" type="text/css" href="..\style\buy.css">
    <link rel="stylesheet" type="text/css" href="..\style\bootstrap.css">
    <link rel="shortcut icon" href="..\logo\logo.png" type="image/x-icon">
</head>
<body>
    <header class="nav">
        <img class="logo" style="width: 90px;" src="..\logo\logo.png">
        <nav>
            <ul>
                <li><h1><a href="../index.php">Home</a></li>
                <li><h1><a href="../user/products.php">Products</a></li>
                <li><h1><a href="../user/contactUs.php">Inquiry</a></li>
                <li class="profile-nav"><h1><a href="../user/cart.php"><img style="width: 70px; " src="../logo/shopping-cart.png" class="profile-image"></a></li>
            </ul>
        </nav>
    </header>
    <section class="boxx">
        <div class="specials">
            <div class="special-lists">
                <form method="POST" enctype="multipart/form-data">
                <ul>
                    <?php
                    if (isset($_GET['ID'])) {
                        $id = $_GET['ID'];
                        
                        $fetch_specific_order = $oop->fetch_specific_order($id);

                         while ($row = mysqli_fetch_array($fetch_specific_order)) {
                            $id = $row['Id'];
                            $product_name = $row['product_name'];
                            $price = number_format($row['price'],2);
                            $produc_img = $row['product_pic'];
                            
                    ?>
                    <li class="crop">
                        <img src="..\products\<?php echo $row['product_pic']; ?>">
                        <div>
                            <h1><?php echo $row['product_name'] ?></h1>
                            <h3>Description</h3>
                            <p> <?php echo $row['description'] ?></p>
                            <h4>₱<?php echo $row['price'] ?></h4>
                            <p><b>Items: </b><input type="number" min="0" name="items" required></p>
                            <button name="buy">ORDER NOW</button>
                        </div>
                    </li>                    
                    <?php
                    }
                    if (isset($_POST['buy'])) {
                        $items = $_POST['items'];
                        if ($fetch_product) {
                            $insert_order = $oop->order($id,$items,$price,$product_name,$produc_img);
                                if ($insert_order) {
                                    $_SESSION['status'] = "YOUR ORDER HAS BEEN PLACE. THANKYOU!";
                                }else{
                                    echo "Something went wrong";
                                }  
                        }else{
                            echo "There was a problem with your order.";
                        }
                        if(isset($_SESSION['status'])){
                            ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align: center;">
                                    <strong>Hi</strong> <?php  echo $_SESSION['status']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            unset($_SESSION['status']);
                        }
                    } 
                }
                    ?>
                </ul>
                </form>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            </div>
        </div>
    </section>
    <footer>
        <p>&copy; 2023 CDV Developer</p>
    </footer>

</body>
</html>