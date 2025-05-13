<?php
    include "..\oop.php";
    $oop = new login_page();

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $sqli_insert = $oop->insert_data($name,$email,$message);
        
        if($sqli_insert){
            $_SESSION['status'] = "Thank you for messaging me, I'll contact you as soon as possible.";
        }else{
            echo "Something went wrong";
        }
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\style\contact.css">
    <link rel="stylesheet" type="text/css" href="..\style\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="..\style\style.css">
    <link rel="shortcut icon" href="..\logo\logo.png" type="image/x-icon">
    
  </head>
  
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?php
      if(isset($_SESSION['status'])){
          ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align: center;">
                  <strong>Hi</strong> <?php  echo $_SESSION['status']; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          <?php
          unset($_SESSION['status']);
      }
    ?>
    <header class="nav">
        <img class="logo"style="width: 90px;" src="..\logo\logo.png">
        <nav>
            <ul>
                <li><h1><a href="../index.php">Home</a></li>
                <li><h1><a href="products.php">Products</a></li>
                <li><h1><a href="#">Inquiry</a></li>
                <li class="profile-nav"><h1><a href="cart.php"><img style="width: 70px; " src="../logo/shopping-cart.png" class="profile-image"></a></li>
            </ul>
        </nav>
    </header>
    <section id="contacts" target="contact">
      <div class="cont-contacts">
            <form action="#" method="POST">
                
                <table>
                    <tr>
                        <th>Get in Touch</th>
                    </tr>
                    <tr>
                        <td> 
                            <label for="fname">Name: </label>
                            <input type="text" placeholder="e.g: Juan Dela Cruz" name="name" required></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email Address:</label>
                            <input type="email" name="email" id="" placeholder="e.g: example@gmail.com" required></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="message">Message:</label>
                            <br><textarea name="message" rows="5" cols="30" placeholder="Enter your message here"></textarea></td>
                    </tr>
                    <tr class="button-center">
                        <td><button name="submit" class="button">Submit</button></td>
                    </tr>
                </table>
            </form>
      </div>
    </section>
    <footer>
        <p>&copy; 2023 CDV Developer</p>
    </footer>
  </body>
</html>