<?php
include "../oop.php";
$oop = new login_page(); 
require_once '../vendor/autoload.php';
use Dompdf\Dompdf;

$pdf = $oop->fetch_records();

$gt = 0;
$reference = '';

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt</title>
  <style>
    h2{
      font-family: monospace;
      text-align: center;
    }
    table{
      font-family: monospace;
      border-collapse: collapse;
      width: 100%;
    }
    td,th{
      border: 1px solid #444;
      padding: 8px;
      text-align: left;
    }
    .my-tab{
      text-align: right;
    }
    #sign{
      text-align: right;
    }
  </style>
</head>
<body>
  <h2>Records</h2>
  <table>
    <thead>
      <tr>
          <th colspan = "6">Sweet Indulgences</th> 
      </tr>
      <tr>
        <th>ID</th>
        <th>Item</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>';

while ($retrieve = mysqli_fetch_assoc($pdf)) {
  $date =$retrieve['Date'];
  $html .= '<tr>
    <td>'.$retrieve['Id'].'</td>
    <td>'.$retrieve['product_name'].'</td>
    <td>'.number_format($retrieve['price'],2).'</td>
    <td>'.$retrieve['items'].'</td>
    <td>'.number_format($retrieve['price'] * $retrieve['items']).'</td>
    <td>'.$retrieve['Date'].'</td>
  </tr>';
  $gt += $retrieve['price'] * $retrieve['items'];
  $reference .= $retrieve['Id']; 
}

$html.='</tbody>
<tr>
  <th colspan="5" class="my-tab">Grand total</th>
  <th>'.number_format($gt,2).'</th>
</tr>
</table>

</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream('Records ('.$date.').pdf');
?>
