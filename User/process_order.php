<?php
include "../oop.php";

$oop = new login_page();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'processOrders') {
        // Process orders, delete from current table, and insert into a new table
        $process = $oop->processOrders();
        if ($process) {
            echo "success";
        }
    }
}
?>
