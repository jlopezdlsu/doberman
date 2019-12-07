<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Transaction History</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="js/jquery-1.10.2.min.js"></script>
	<link href="css/style.css" rel="stylesheet">
</head>

<body>

<?php
session_start();
include('conn.php');

include('header.php');
?>
</br>
</br>
</br>
</br>
<div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header">
				<div class="panel panel-default" style="padding-top:100px;">
	        		<div class="box box-solid">
	        			<div class="box-header with-border">
	        				<h4 class="box-title"><i class="fa fa-calendar"></i> <b>Transaction History</b></h4>
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered" id="example1">
	        					<thead>

	        						<th>Payment ID</th>
	        						<th>Total Amount</th>
	        						<!--<th>Payment Type</th>-->
	        						<th>Payment Code</th>
	        					</thead>
	        					<tbody>
	        						<?php
										require_once('conn.php');
										/**$result = $connect->prepare("SELECT * FROM tbl_payment WHERE buyerID=:buyerID ORDER BY paymentID ASC");
										$result->execute(['buyerID'=>$user['id']]);**/
										$result = $connect->prepare("SELECT * FROM tbl_payment WHERE buyerID=".$_SESSION["userID"]." ORDER BY paymentID ASC");
										$result->execute();
										for($i=0; $row = $result->fetch(); $i++){
									?>
										<tr>
											<td><label><?php echo $row['paymentID']; ?></label></td>
											<td><label><?php echo $row['total']; ?></label></td>
											<!--<td><label><?php echo $row['paymentType']; ?></label></td>-->
											<td><label><?php echo $row['paymentCode']; ?></label></td>
										</tr>
										<?php } ?>
	        					</tbody>
	        				</table>
	        			</div>
	        		</div>
				</div>
	        </div>
		</div>
	 </div>
</body>
</html>
