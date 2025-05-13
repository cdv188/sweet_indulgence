<?php
  include '../oop.php';
  $oop = new login_page(); 

    $delete = $oop->delete_all_records();
    if($delete){
      header('location:records.php');
    }
  
?>