<?php
    session_start();
    include "oop.php";

    $oop = new login_page();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style\login-style.css">
    <link rel="shortcut icon" href="logo\logo.png" type="image/x-icon">

</head>
<body>
        <div class="logo"></div>

    <main class="login">
        <div class="login-container">
            <h2>Admin</h2>
        <?php   
            if(isset($_POST['login'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $admin = $oop->fetch_admin($username);


             if (mysqli_num_rows($admin) > 0) {
                while ($row = mysqli_fetch_array($admin)) {
                    $db_username = $row['Username'];
                    $db_password = $row['Password'];

                    if (md5($password)==$db_password && $username == $db_username) {
                        $_SESSION['USERNAME'] = $db_username;
                        $_SESSION['PASSWORD'] = $db_password;
                        header('location:Admin/admin.php');
                    }else{
                        echo '<h4 style="text-align:center; color: red;">Incorrect Username or Password</h4>';
                    }
                }
            } else {
                echo '<h4 style="text-align:center; color: red;">Incorrect Username or Password</h4>';
            }
        }
        
        ?>
            <form class="login-form" method="post">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button name="login">Login</button>
            </form>
        </div>
    </main>

    <footer class="login-foot">
        &copy; 2023 CDV Developer
    </footer>
</body>
</html>
