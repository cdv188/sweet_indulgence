<?php
    session_start();
    include "../oop.php";

    $oop = new login_page();

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
        <form method="POST" enctype="multipart/form-data">
            <div class="specials">
                <div class="special-lists">
                    <ul>
                        <li class="adds">
                            <div class="row-add">
                                <input type="file" name="product">
                                <h4>Price: <input type="text" name="price" ></h4>
                                <label for="message"><b>Message: </b></label>
                                   <textarea name="message"  cols="1" style="margin-right: 5px;"></textarea>
                                <h3>Name:  <input type="text" name="name" ></h3>
                                <button name="add">add</button>
                            </div>
                        </li>
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
<?php
if(isset($_POST['add']) && isset($_FILES['product'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $message = $_POST['message'];
            echo "<pre>";
            print_r($_FILES['product']);
            echo "</pre>";
            $img_name = $_FILES['product']['name'];
            $img_size = $_FILES['product']['size'];
            $tmp_name = $_FILES['product']['tmp_name'];
            $error = $_FILES['product']['error'];
            if ($error === 0) {
                if($img_size > 10000000){
                    $em = "Sorry, your file is too large.";
                    header("Location: add.php?error=$em");
                }else{
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg","jpeg","png");
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $target_dir = "../products/";
                        $target_file = $target_dir . $img_name;
                        move_uploaded_file($tmp_name, $target_file);
                        $sqli_insert = $oop->insert_product($name,$img_name,$message,$price);
                        header("location:admin.php");
                    }else{
                        $em = "You can't upload files of this type";
                        header("Location: add.php?error=$em");
                    }
                }
            }else{
                $em = "unknown error occurred!";
                header("Location: add.php?error=$em");
            }
        }
?>