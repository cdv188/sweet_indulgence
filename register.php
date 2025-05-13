<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="style\registration-style.css">
    <link rel="shortcut icon" href="logo\logo.png" type="image/x-icon">

</head>
<body>
    <main class="register">
        <div class="registration-container">
            <h2>Registration</h2>
            <?php 
                if (isset($_GET['error'])): ?>
                    <p><?php echo $_GET['error']; ?></p>
            <?php endif ?>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="fname" placeholder="First Name" required>
                <input type="text" name="lname" placeholder="Last Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="text" name="phone_number" placeholder="Phone Number" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="file" name="profile">
                <button name="register">Create Account</button>
            </form>
        </div>
    </main>

    <footer>
        &copy; 2023 CDV Developer
    </footer>
    
</body>
</html>
<?php 
    session_start();
    include "oop.php";
    $oop = new login_page();


    if(isset($_POST['register']) && isset($_FILES['profile'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $encrypt_pass = md5($password);//Encrypt the password
        $confirm_password = $_POST['confirm_password'];
        
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone_number'];
    
        if ($password !== $confirm_password) {
            echo '<script>alert("Passwords do not match");</script>';
        } else {
            // Passwords match, proceed with registration
            echo "<pre>";
            print_r($_FILES['profile']);
            echo "</pre>";
            $img_name = $_FILES['profile']['name'];
            $img_size = $_FILES['profile']['size'];
            $tmp_name = $_FILES['profile']['tmp_name'];
            $error = $_FILES['profile']['error'];
            if ($error === 0) {
                if($img_size > 325000){
                    $em = "Sorry, your file is too large.";
                    header("Location: register.php?error=$em");
                }else{
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg","jpeg","png");
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("$fname",true).'.'.$img_ex_lc;
                        $img_path = 'upload-img/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_path);

                        $sqli_insert = $oop->insert_register($username,$encrypt_pass,$fname,$lname,$email,$phone,$new_img_name);
                        header("location:index.php");
                    }else{
                        $em = "You can't upload files of this type";
                        header("Location: register.php?error=$em");
                    }
                }
            }else{
                $em = "unknown error occurred!";
                header("Location: register.php?error=$em");
            }
        }         
    }
    
?>

