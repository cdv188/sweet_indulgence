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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Message</title>
    <link rel="stylesheet" type="text/css" href="..\style\style.css">
    <link rel="shortcut icon" href="..\logo\logo.png" type="image/x-icon">
</head>
<body>
<div class="logo"></div>
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
    <style type="text/css">
        body{
            background-image: url("../logo/back.png");
            background-color: #FFEAD0;
            background-size: 300px;
        }
        center{
            color: white;
            font-size: 50px;
        }
        section{
            margin: auto;
        }
        tbody{
            background-color: #606c88;
            border-radius: 10px;
            color: white;
            font-size: 15px;
        }
        table,th,td{
            border-radius: 5px;
        }
        tr th{
            background-color: #DD3F2F;
            text-align: center;
            padding: 15px;
             max-width: 400px
        }
        tr td{
            background-color: black;
            text-align: center;
            padding: 15px;
            max-width: 400px
        }
        .message {
            max-width: 400px; /* Adjust this width as needed */
            word-wrap: break-word;
        }
        .menu-container {
          color: white;
          position: relative;
          text-decoration: none;
          font-size: 20px;
          background-color: #DD3F2F;
          padding: 5px;
          border-radius: 10px;
        }

        .menu-container::before {
          content: '';
          position: absolute;
          width: 100%;
          height: 4px;
          border-radius: 4px;
          background-color: white;
          bottom: 0;
          left: 0;
          transform-origin: right;
          transform: scaleX(0);
          transition: transform .3s ease-in-out;
        }

        .menu-container:hover::before {
          transform-origin: left;
          transform: scaleX(1);
        }

        ::-webkit-calendar-picker-indicator {
          background-color: #ffffff;
          padding: 5px;
          cursor: pointer;
          border-radius: 3px;

        }
         table {
            margin: auto;
        }
        center{
            color: black;
        }
    </style>
    <section >
            <table>
                <?php
                    $fetch = $oop->fetch_data();

                    if (mysqli_num_rows($fetch)<1){
                        echo "<center><h1>NO RECORDS FOUND</h1></center>";
                    }else{
                    echo "<tr>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>MESSAGE</th>
                            <th>Time&Date</th>
                            <th>ACTION</th>
                        </tr";
                    while($row = mysqli_fetch_array($fetch)){
                        $id = $row['Id'];
                ?>
                <tr>
                    <td>
                        <?php echo $row['Fname']; ?>             
                    </td>
                    <td>
                        <?php echo $row['Email']; ?>  
                    </td>
                     <td class="message">
                        <?php echo $row['message']; ?>     
                    </td>
                    <td>
                        <?php echo $row['DateAndTime']; ?>  
                    </td>

                    <td>
                        <a href="delete_message.php?ID=<?php echo $id; ?>" class="menu-container">Delete</a>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </table>
    </section>
</body>
</html>