<?php
include("../dataconn/dataconn.php");
if(!isset($_SESSION))
{
  session_start();
}
$user_id = $_SESSION['user_id'];
if(isset($_POST['purchase_product'])){
  $date = date('Y-m-d');

  $product_id = $_REQUEST['product_id'];
  $product_sql = "select * from product where product_id = ".$product_id." ";
  $product_exe = mysql_query($product_sql);
  $product_row = mysql_num_rows($product_exe);
  $product_image = "";
  do {
    $product_price = $product_row['Product_Price'];
  }while($product_row = mysql_fetch_array($product_exe));

  $quantity_value_final = $_POST['quantity_value_final'];
  $total_price_value = $product_price*$quantity_value_final;
  $final_submit_SQL = "INSERT INTO `sold`(`Sold_Type`, `Sold_Date`, `Sold_Price`, `Quantity`, `User_ID`, `Prodcut_ID`) VALUES ('1','".$date."',".$total_price_value.",".$quantity_value_final.", ".$user_id." ,".$product_id.")";
  $final_submit_SQL_exe = mysql_query($final_submit_SQL);
  if (!$final_submit_SQL_exe) {
      die('Invalid query: ' . mysql_error());
      echo   $final_submit_SQL;
  }
  else {
    header("Location: index.php");
  }
}
?>
