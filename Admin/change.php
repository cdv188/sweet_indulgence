<?php
	session_start();
    include "../oop.php";

    $oop = new login_page();
     

    if(!isset($_SESSION['USERNAME'])){
        header("location:../admin.php");

    }
    if(isset($_GET['ID'])){
     	$id = $_GET['ID'];
        $fetch_product = $oop->fetch_specific_order($id);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="..\style\admin.css">
    <link rel="shortcut icon" href="..\logo\logo.png" type="image/x-icon">
    <style>
        body{
            background-image: url("../logo/back.png");
            background-color: #FFEAD0;
            background-size: 300px;
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
        
    </main>
    <center style="margin: auto;">
        <button name="add" class="add" onclick="document.location='add.php'" style="margin:auto;">Add Product</button>
        <form method="POST">
            <div class="specials">
                <div class="special-lists">
                    <ul>
<?php
                        if (mysqli_num_rows($fetch_product)<1){
                             echo "<center><h1>NO PRODUCTS FOUND</h1></center>";
                    }else{
                        while ($row = mysqli_fetch_array($fetch_product)) {
                            $name = $row['product_name'];
                            $price = $row['price'];
                            $message = $row['description'];
?>

                        <li class="adds">
                            <div class="cart">
                                <img src="..\products\<?php echo $row['product_pic']; ?>">
                                
                                <h4>Price: <input type="text" name="price" value="<?php echo $price ?>"></h4>
                                <h3>Name:  <input type="text" name="name" value="<?php echo $name ?>"></h3>
                                <label for="message"><b>Message: </b></label>
                                   <textarea name="message"  wrap="hard"><?php echo $message ?></textarea>
                                <button name="change">Change</button>
                                <?php echo $id;?>
                            </div>
                        </li>
<?php
}
                     }

                      
    }
                         if (isset($_POST['change'])) {
                     	$name = $_POST['name'];
                     	$price = $_POST['price'];
                     	$message = $_POST['message'];
                     	
                     	$change_order = $oop->change_order($name,$message,$price,$id);
                     	if ($change_order) {
                     		header("location:admin.php");	
                     	}else{
                     		echo "Something went Wrong";
                     	}

                     }
?>
                    </ul>
                </div>
            </div>
        </form>
    </center>
    <footer>
        <p>&copy; 2023 CDV Developer</p>
    </footer>
</body>
</html>