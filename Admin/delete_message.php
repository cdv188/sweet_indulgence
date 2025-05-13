<?php
  include '../oop.php';
  $oop = new login_page(); 

  if(isset($_GET['ID'])){
    $id = $_GET['ID'];
    $delete = $oop->delete_message($id);
    if($delete){
      header('location:message.php');
    }
  }
  
?>