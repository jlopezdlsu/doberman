<?php
session_start();
require_once '../connmysqli.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $json = array();
  if(isset($_SESSION['success']) && $_SESSION['success']){
    if((isset($_POST['product_num']) && !empty(trim($_POST['product_num'])) && isset($_SESSION['userID'])))
    {

      $userID = $_SESSION['userID'];
      $product_num = $_POST['product_num'];
      $product_qty = 1;

      //CHECK IF PRODUCT IS EXISTING IN THE CART
      $selectQry = "SELECT productID FROM tbl_order WHERE productID = '$product_num'";
      $result = mysqli_query($db, $selectQry);
      $data = mysqli_fetch_assoc($result);

      if($data == false){
        $query = "INSERT INTO tbl_order (productID, buyerID, quantity) VALUES ($product_num,$userID,$product_qty)";

      }else{
        //IF PRODUCT IS ALREADY IN THE CART UPDATE QUANTITY
        $query = "UPDATE tbl_order SET quantity = quantity + 1 WHERE productID = '$product_num'";

      }

      if(mysqli_query($db, $query)){
        $json['status'] = 100;
        $json['msg'] = "Product Successfully Added In Cart";
      }else{
        $json['status'] = 104;
        $json['msg'] =    mysqli_error($db);
      }

      //


    }else{
      $json['status'] = 104;
      $json['msg'] = "Invalid Data Values Not Allow";
    }
  }else{
    $_SESSION['LOGIN_REFERRED'] = $_SERVER['HTTP_REFERER'];
    $json['status'] = 107;
    $json['msg'] = "User not logged in.";
  }


  echo json_encode($json);
}


?>
