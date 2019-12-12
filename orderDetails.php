<?php
include('auth.php');

include('conn.php');

if(isset($_POST["submitReview"])){
	$rate = $_POST['star'];
	$comment = $_POST['description'];
	$id = $_POST['order'];
	$user = $_SESSION['userID'];

	$query = $connect->prepare("INSERT INTO tbl_review(productID,userID,comment,rating) VALUES(?,?,?,?)");
	if($query->execute([$id,$user,$comment,$rate])){
		echo 'Successfully added review';
	}else{
		echo 'Something is wrong, please try again';
	}

}
?>

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
	<?php include('header.php');?>

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

									<th>Order ID</th>
									<th>Product Name</th>
									<!--<th>Payment Type</th>-->
									<th>Price</th>
									<th>Quantity</th>
									<th></th>

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
									$result = $connect->prepare("SELECT tbl_order.orderID,tbl_order.quantity,tbl_product.price, tbl_order.productID,tbl_product.productName FROM tbl_order LEFT JOIN tbl_product ON tbl_order.productID = tbl_product.productID WHERE tbl_order.paymentID=".$_GET["s"]."");
									$result->execute();
									$rows = $result->fetchAll();
									$total = 0;
									foreach($rows as $row){
										$total += $row['price'] * $row['quantity'];
										?>
										<tr>
											<td><label><?php echo $row['orderID']; ?></label></td>
											<td><label><?php echo $row['productName']; ?></label></td>
											<!--<td><label><?php echo $row['paymentType']; ?></label></td>-->
											<td><label><?php echo $row['price']; ?></label></td>
											<td><label><?php echo $row['quantity']; ?></label></td>
											<td> <input type="button" class="btn btn-success" data-id="<?php echo $row['productID']; ?>" data-product="<?php echo $row['productName'];?>" data-toggle="modal" id="reviewBtn" value="Submit A Review">

											</tr>
											<?php
										}

										?>

									</tbody>
								</table>

								<b>TOTAL: PHP</b> <?php echo number_format($total,2) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="reviewModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Review</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form class="" method="post">
							<b>PRODUCT: </b><p id="productName">Some text in the modal.</p>
							<div class="stars">
								<input class="star star-5" id="star-5" type="radio" value="5" name="star"/>
								<label class="star star-5" for="star-5"></label>
								<input class="star star-4" id="star-4" type="radio" value="4" name="star"/>
								<label class="star star-4" for="star-4"></label>
								<input class="star star-3" id="star-3" type="radio" value="3" name="star"/>
								<label class="star star-3" for="star-3"></label>
								<input class="star star-2" id="star-2" type="radio" value="2" name="star"/>
								<label class="star star-2" for="star-2"></label>
								<input class="star star-1" id="star-1" type="radio" value="1" name="star"/>
								<label class="star star-1" for="star-1"></label>
							</div>
							<textarea name="name" rows="8" cols="80" placeholder="Comment" class="form-control" name="description"></textarea>


							<input type="hidden" id="orderID" name="order" value="">
							<br>
							<center><button type="submit" name="submitReview" class="btn btn-primary float-right">Submit Review</button></center>

						</form>
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

	$("#reviewBtn").on("click",function(e){
		var modal = $("#reviewModal");
		modal.find("#productName").html($(this).data('product'));
		modal.find("#orderID").val($(this).data('id'));

		modal.modal('show');
	});
});
</script>
