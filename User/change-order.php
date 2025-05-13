<?php
    include "../oop.php";

    $oop = new login_page();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Sweet Indulgences</title>
    <link rel="stylesheet" type="text/css" href="..\style\admin.css">
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
                <li class="profile-nav"><h1><a href="cart.php"><img style="width: 70px; " src="../logo/shopping-cart.png" class="profile-image"></a></li>
            </ul>
        </nav>
    </header>
    <main>
        
    </main>
    <section>
        <form method="POST" >
            <div class="specials">
                <div class="special-lists">
                    <ul>
                        <?php
                        if (isset($_GET['ID'])) {
                            $id = $_GET['ID'];
                            $change_specific_order = $oop->change_specific_order($id);

                        if (mysqli_num_rows($change_specific_order)<1){
                             echo "<center><h1>NO ORDERS FOUND</h1></center>";
                    }else{
                        while ($row = mysqli_fetch_array($change_specific_order)) {
                            $price = $row['price'];
                            $items = $row['Items'];
                            $total = $price * $items;
                        ?>

                        <li>
                                <div>
                                <img src="..\products\<?php echo $row['product_img']; ?>">
                                
                                <h4>Price: <?php echo number_format($total, 2); ?></h4>
                                <p><h3>Product Name: </h3><?php echo $row['product_name'] ?>&nbsp</p>
                                <p><h3>Items: </h3><input type="text" name="itemsChange" value="<?php echo $row['Items'];?>"></p>
                                <button name="save" class="add change" style="margin: 5px auto; padding: 5px;">Save</button>
                                <button name="delete" class="add" style="margin: auto;">Delete</button>
                            </div>
                            
                        </li>
                        <?php
                        }
                    }
                }
                     ?>
                      </form>         
                    </ul>
                    <a href="products.php" class="add" style = "width: 120px; margin:auto;">Buy More</a>
                </div>
            </div>
        
    </section>
    <footer>
        <p>&copy; 2023 CDV Developer</p>
    </footer>
</body>
</html>
<?php
if (isset($_POST['save'])) {
        $items_change = $_POST['itemsChange'];
        $update = $oop->update_order($items_change,$id);
        if ($update) {
        header("location: cart.php");
        }
    }
        if (isset($_POST['delete'])) {
        $delete_product = $oop->delete($id);
            if ($delete_product) {
               header("location: cart.php"); 
            }
    }
?>