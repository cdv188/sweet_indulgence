<?php
  include '../oop.php';
  $oop = new login_page(); 

  if(isset($_GET['ID'])){
    $id = $_GET['ID'];
    $delete = $oop->delete_complete_order($id);
    if($delete){
      header('location:records.php');
    }
  }
  
?>