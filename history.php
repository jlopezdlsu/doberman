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
	<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


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
							<center>	<h4 class="box-title"><i class="fa fa-calendar"></i> <b>Transaction History</b></h4> </center>
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

									function _group_by($array, $key) {
										$return = array();
										foreach($array as $val) {
											$return[$val[$key]][] = $val;
										}
										return $return;
									}
									/**$result = $connect->prepare("SELECT * FROM tbl_payment WHERE buyerID=:buyerID ORDER BY paymentID ASC");
									$result->execute(['buyerID'=>$user['id']]);**/
									$result = $connect->prepare("SELECT * FROM tbl_order LEFT JOIN tbl_payment ON tbl_order.paymentID = tbl_payment.paymentID WHERE tbl_order.paymentID is not null AND tbl_order.buyerID=".$_SESSION["userID"]."");
									$result->execute();
									$rows = $result->fetchAll();
									$datas = _group_by($rows, 'paymentID');

									foreach($datas as $data){
										foreach($data as $product){
											?>
											<tr>
												<td><label><a href="orderDetails.php?s=<?php echo $product['paymentID']; ?>" ><?php echo $product['paymentID']; ?></a></label></td>
												<td><label><?php echo $product['total']; ?></label></td>
												<!--<td><label><?php echo $product['paymentType']; ?></label></td>-->
												<td><label><?php echo $product['paymentCode']; ?></label></td>
											</tr>
											<?php
										}
									}?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('footer.php') ?>
</body>
</html>

<script type="text/javascript">
$(document).ready( function () {
	$('table').DataTable();
} );
</script>
