<?php
session_start();
require_once '../connmysqli.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $json = array();
  $contentType = isset($_SERVER["CONTENT_TYPE"]) ?trim($_SERVER["CONTENT_TYPE"]) : '';

  if ($contentType === "application/json") {
    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);

    //If json_decode failed, the JSON is invalid.
    if(! is_array($decoded)) {
      $json['status'] = 500;
      $json['msg'] = "Invalid JSON";
    } else {

      $user = $_SESSION['userID'];
      $total = $decoded['total'];
      $orderIDs = implode(',', array_map('intval', $decoded['orderIDs']));
      $paymentType = 'paypal';
      $code = $decoded['orderID'];

      $query = "INSERT INTO tbl_payment (buyerID, total, paymentType, paymentCode)
      VALUES( '$user', '$total', '$paymentType','$code')";
      //INSERT PAYMENT
      if(mysqli_query($db, $query)){
        $paymentID =  mysqli_insert_id($db);
        //UPDATE ORDER WITH PAYMENT ID
        $updateQuery = "UPDATE tbl_order SET paymentID = '$paymentID' WHERE orderID IN ($orderIDs)";
        if(mysqli_query($db, $updateQuery)){
          $json['status'] = 105;
          $json['msg'] = "PAID";
        }else{
          $json['status'] = 105;
          $json['msg'] =  mysqli_error($db);
        }

      }
      else{
        $json['status'] = 500;
        $json['msg'] = mysqli_error($db);
      }
    }
  }
}
else{
  $json['status'] = 105;
  $json['msg'] = "Invalid Request Found";
}


echo json_encode($json);

?>
