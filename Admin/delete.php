<?php
  include '../oop.php';
  $oop = new login_page(); 

  if(isset($_GET['ID'])){
    $id = $_GET['ID'];
    $delete = $oop->delete_process_order($id);
    if($delete){
      header('location:order.php');
    }
  }
  
?>