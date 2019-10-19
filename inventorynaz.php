<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title></title>
</head>
<body class="pt-3">

</html>


  <!-- Main Content -->
  <div class="container containerBody" >
    <div class="row">
      <div class="col-lg-12">
        <?php

	$db_username        = 'root'; //MySql database username
$db_password        = ''; //MySql database password
$db_name            = 'dobermann'; //MySql database name
$db_host            = 'localhost'; //MySql hostname or IP

$currency           = '&#x20B1; '; //currency symbol
$shipping_cost      = 50; //shipping cost

$conn = new mysqli($db_host, $db_username, $db_password,$db_name); //connect to MySql


if ($conn->connect_error) {//Output any connection error
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
	}
   
   if (isset($_POST['txtSpecs'])) {
    // Escape any html characters
    echo htmlentities($_POST['txtSpecs']);
}


  // -=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //  PHP FOR EDITING Menu
  // -=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


  $editSuccess = false;
  if(isset($_POST["btnEditItem"])) {
  	$itemCode = $_POST['txtCode']; 	
	$itemName = $_POST['txtName'];
    $itemDesc = $_POST['txtDescription'];
    $itemPrice = $_POST['txtPrice'];
    $itemBrand = $_POST['txtBrand'];
    $itemCategory = $_POST['category'];
    $itemDiscount = $_POST['txtDiscount'];

    $itemFeatured = $_POST['yesorno'];
    $itemQty = $_POST['txtQty'];
	$fileName = "";

    $target_dir = "../themes/images/products/";
    $target_file = $target_dir . basename($_FILES["fileImage"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $imageSrc = "themes/images/products/".$_POST['txtName'].".".$imageFileType; // Image src for database
    $fileName = $target_dir.$_POST['txtName'].".".$imageFileType;
    $check = getimagesize($_FILES["fileImage"]["tmp_name"]); // Returns false if file is not image

    $sql="SELECT * FROM products ;";
    $result=$conn->query($sql);
    if ($result->num_rows >=1) {
 
    	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			echo "Sorry, only JPG, JPEG and PNG files are allowed.";
		} 
		else if($check == false) {
			echo "<center><div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
			Invalid image file.
			</div>";
		}
		if (file_exists("$fileName")) unlink("$fileName");
		if (move_uploaded_file($_FILES["fileImage"]["tmp_name"], $fileName)) {
			$sql="";
			
			$sql="UPDATE
			products
			SET
			name = '$itemName',
			description = '$itemDesc',
			price = '$itemPrice',
			brand = '$itemBrand',
			category = '$itemCategory',
			imgsrc = '$imageSrc',
			discount = '$itemDiscount',
			featured = '$itemFeatured',
			qty = '$itemQty'
			WHERE CODE
			= '$itemCode';";

			$conn->query($sql);
			$editSuccess = true;
		} 
		else {
			echo "<center><div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
			Error uploading image.</div>";
		}  
	}
    else {
      	echo "<center><div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
            This item code doesn't exist. Please refer to list of all items.
          </div>";
    }
  }
?>

 <!DOCTYPE html>
	<html class="no-js">
	<head>
	<?php // Prevents caching of page
		header("Pragma-directive: no-cache");
	    header("Cache-directive: no-cache");
	    header("Cache-control: no-cache");
	    header("Pragma: no-cache");
	    header("Expires: 0");
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Voltshop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic|Merriweather:300,400italic,300italic,400,700italic' rel='stylesheet' type='text/css'>
	
	<!--bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>t
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/simple-line-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../css/bootstrap.css">

	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/cart.css">
	
	<!-- Modernizr JS -->
	<script src="../js/modernizr-2.6.2.min.js"></script>

	</head>
	<body background="../bgtech.png"><center>
	<?php
	if (isset($_POST['statusupdate'])){
		// Update IF STATUSUPDATE has value
		$sql="update additem SET Status=".$_POST['statusupdate']." where id=".$_POST['statusid']." ;";
		$conn->query($sql);
	}
	if (isset($_POST["btnEditItem"])) {
		if ($editSuccess) {
			echo "<center><div class='alert success'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>Item successfully edited.</div>";
		}
		else {
			echo "<center><div class='alert warning'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
			  An error was encountered when editing the item's information.
			</div>";
		}
	}
	?>
	<form name = 'viewAccounts' id='viewAccounts' method='POST' action='inventory.php'>
	<?php 
		if(isset($_POST['delete'])){
			if(!empty($_POST['select'])) {
				foreach($_POST['select'] as $check) {
					$file_pattern = "../themes/images/products/"."$check"."*";
					array_map( "unlink", glob( $file_pattern ) );
					$sql = "DELETE FROM products WHERE name = '$check'";
					$conn->query($sql);
				}
			}
			else{
				echo "<center><div class='alert warning'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
	  Please select an item to delete first.
	</div>";
			}
		}

		if(isset($_POST['delete'])){
			if(!empty($_POST['select'])) {
					echo "<center><div class='alert success'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
	  Successfully deleted selected item(s).
	</div>";
			}
		}

		$sql = "SELECT * from products;";
		$result = $conn->query($sql);

		echo"  	<br><br><font style='color:#fffbc2; font-size:45px;'>Welcome Admin!</font><br>
		
		<font style='color:#fffbc2; font-size:18px;'>Actions: </font><a href='addmenu.php'style='text-decoration:none; color:#c2dcff;'><u>Add Item</u></a>
		<font style='color:#fffbc2; font-size:18px;'> | </font><a href='#Edit' class='smoothScroll' style='text-decoration:none; color:#c2dcff;'><u>Edit Item</u></a>
		<font style='color:#fffbc2; font-size:18px;'> | </font><a href='vouchers.php' style='text-decoration:none; color:#c2dcff;'><u>Vouchers</u></a>
		<font style='color:#fffbc2; font-size:18px;'> | </font>
	
	<a href='viewinfo.php' style='text-decoration:none; color:#c2dcff;'><u>View Customer and Order Info.</u></a>
	
	<table border=0 align=center width=\"50%\" style='box-shadow: 5px 5px 5px 5px #000; font-size:20px;background-color:rgba(255,255,255,0.8);'>
		<br><br><br><center>
		<tr style='padding:20px;'>
			<th class='td_search1' style='padding-left:5px;'>Search:</th>
			<td>
				<input type='text' name='txtSearch' placeholder='Type Here' class='textboxx'>
			</td>
			<th>By: </th>
			<td>
				<select name='cmbSearchBy' required class='td_select selecta'>
					<option value='name'>Item Name</option>
					<option value='brand'>Brand</option>
					<option value='category'>Category</option>
				</select>&nbsp;&nbsp;&nbsp;
			</td>
			<td class='td_search5'>
				<input type='submit' name='search' value='Search' class=' buttones' style='margin:5px'>
			</td>
		</tr>
		</table><br>
		";

		/*if(isset($_POST["search"])){
			$cmbSearchBy = $_POST["cmbSearchBy"];
			$txtSearch = $_POST["txtSearch"];
			$sql = "SELECT * FROM products WHERE $cmbSearchBy LIKE '%$txtSearch%'";
			$result = $conn->query($sql);
		}*/
		$sql = "SELECT * FROM additem;";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
			echo "
			<center>
			<div class='col-sm-2'>
			 <center> Search </center>
			 </div>
			<div class='col-sm-10>
			<table border=0 align=center width='80%'0 style='padding:20px;box-shadow: 10px 10px 10px 10px #000; font-size:15px;background-color:rgba(255,255,255,0.8);'><tr><td><center>
			<font style='color:#000; font-size:35px;'>Inventory System</font><br>
			<table border='1' class='table table-bordered'>
			<thead>

			<tr>
				<th scope='col'>
					Id
				</th>
				<th scope='col'>
					Item Name
				</th>
				
					<th scope='col'>
				Short Description
				</th>
					<th scope='col'>
					Price
				</th>
				<th scope='col'>
					Specification
				</th>
				<th scope='col'>
					Category
				</th>
					<th scope='col'>
					Discount
				</th>
					<th scope='col'>
				Image
				</th>
				
				<th scope='col'>
					Description
				</th>
				<th scope='col'>
					Qty
				</th>
				<th scope='col'>
					SKU
				</th>
				<th scope='col'>
					Status
				</th>
			
			</tr>
			</thead> 
			<tbody>
			";

		    while($row = $result->fetch_assoc()) {	
		    	
		   

				echo "
				<tr>
					
					<td>
						".$row['id']."
					</td>
					<td>
						".$row['ItemName']."
					</td>
					<td>
						".$row['shortDesc']."
					</td>
					<td>
						".$currency.$row['price']."
					</td>
					<td>
						".$row['specs']."
					</td>
					<td>
						".$row['category']."
					</td>
					<td>
						".$row['discount']."
					</td>
					<td>
						".$row['description']."
					</td>
					<td style='padding:5px'>
						<img src='".$row['imgsrc']."' length='80' width='80' alt='".$row['id']."'><br><br>
					</td>
				
					<td>
						".$row['qty']."
					</td>
					<td>
						".$row['sku']."
					</td>
					<td>
						";
							// Mag lalagay ng property na checked pag yung status sa database ay true
							if($row['Status']){ 
								$xString = 'checked'; 
							} 
							else { 
								$xString = ''; 
							} 
							//Gumagawa ng function kada checkbox para mag update ng status
					echo "
						<center><input type='checkbox' id='chk".$row['id']."' onclick='myFunction(".$row['id'].")' ".$xString."></center>
						<script language='javascript'>
							function myFunction(id) {
							var ischeck=$('#chk'+ id).is(':checked',true);
							  $('#viewAccounts').append('<input type=\"hidden\" id=\"statusid\" name=\"statusid\" value=' + id + '>');
							  $('#viewAccounts').append('<input type=\"hidden\" id=\"statusupdate\" name=\"statusupdate\" value=' + ischeck + '>');
							  $('#viewAccounts').submit();
							}
						</script>
					</td>
				</tr>
				";
		    }
		 echo "
	 		<tr>
		 		<td colspan='13' style='padding-top:30px;padding-bottom:30px; background-color:#5b4a44'>
		 			<center><input type='submit' name='delete' value='Delete Selected Item(s)' class='td_delete buttones2'>
		 		</td>
		 	</tr>
		 </tbody>
		 </table><br></table><br><br><br><br>
		 </div>
		 
		 
		
		 </center>
		 ";
		}
		else {
			echo "<center><div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>Sorry no menu found.<br>Please do press \"Search\" button once again to view all items.
			</div>";
		}
	 	$conn->close();
	 	ob_end_flush();
	 ?>
	 </form>
<a name="Edit" style="position:absolute;"></a>
	<form action="adminmenu.php" name="formEditMenu" method="POST" enctype="multipart/form-data">
		<table border=0 align=center width="80%" style='box-shadow: 5px 5px 5px 5px #000; font-size:20px;background-color:rgba(255,255,255,0.8);'>
<tr><td><center><br>

	<table border=0 class="tbl_edit" style='width:90%; text-align:center;'>
		<tr  colspan=2 style="background-color:#353638; padding:20px; text-align:center;">
			<th colspan="2"><center><br>
				<font style="font-size:35px; color:#fffbc2;">Edit Item</font><br>
				<p style="font-size:15px; font-style:italic; color:#FFF;">"You may leave some fields blank if you don't want to change the item information saved in the system." </p><br>
			</th><tr><td style="background-color:#FFF;"></center><br>
	<br>
 				<b>Item Code:</b><br>
 				<input class="textboxxx" type="text" name="txtCode" maxlength="10" required placeholder="Enter the item code of the item that you want to edit (e.g. 1)"><br><br>
 		
	<hr>
				<font size=6>New Information</font><br><br>

				<b>Item Name:</b><br>
 				<input class="textboxxx" type="text" name="txtName" placeholder="New item name" required><br><br>

 				<b>Description:</b><br>
 				<input class="textboxxx" type="text" name="txtDescription" placeholder="New item description" required><br><br>

 				<b>Price:</b><br>
 				<input class="textboxxx" type="text" name="txtPrice" placeholder="New item price" required><br><br>

 				<b>Brand:</b><br>
 				<input class="textboxxx" type="text" name="txtBrand" placeholder="New item brand" required><br><br>

 				<b>Category:</b><br>
				<select name="category">
					<option value="Camera">Camera</option>
					<option value="Computers, Tablets & Laptops">Computers, Tablets & Laptops</option>
					<option value="Mobile Phone">Mobile Phone</option>
					<option value="Storage Devices">Storage Devices</option>
					<option value="Sound & Vision">Sound & Vision</option>
				</select><br><br>

				<b>Item Discount:</b><br>
 				<input class="textboxxx" type="text" name="txtDiscount" placeholder="New item discount" required><br><br>

 				<b>Image:</b><br>
 				<center><div style='border:solid 2px #000; width:40%; text-align:center;'><input type="file" name="fileImage" id="fileImage" accept=".png, .jpg, .jpeg"></div></center><br>

 				<b>Featured:</b><br>
 				<input type="radio" name="yesorno" value="Yes" required>Yes
          		<input type="radio" name="yesorno" value="No" required>No<br><br>
          		
          		<b>Qty:</b><br>
          		<input type="text" class="textboxxx" required name="txtQty"><br><br>
			</tr>
			<tr>
			<td style="background-color:#353638; padding:20px; text-align:center;">
 				<center><br>
				<button class="buttones3" type="reset" value="Reset">Reset Changes</button>&nbsp;
				<input class="buttones3" type="submit" name="btnEditItem" value="Save Changes">
				<br><br></td>
 		</tbody>
	</table><br></table></form>

	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Bootstrap DateTimePicker -->
	<script src="../js/moment.js"></script>
	<script src="../js/bootstrap-datetimepicker.min.js"></script>
	<!-- Waypoints -->
	<script src="../js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="../js/jquery.stellar.min.js"></script>

	<!-- Flexslider -->
	<script src="../js/jquery.flexslider-min.js"></script>
	<!-- Main JS -->
	<script src="../js/main.js"></script>
<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
} 
		  
		 
		
</script>

<style>
	body
	{
			width:100%;
		background-image: url("../images/bgtech.png");
		background-size:cover;
	}
	.alert {
		padding: 20px;
		background-color: #f44336;
		color: white;
		opacity: 1;
		transition: opacity 0.6s;
		margin-bottom: 15px;
	}

	.alert.success {background-color: #4CAF50;}
	.alert.info {background-color: #2196F3;}
	.alert.warning {background-color: #ff9800;}

	.closebtn {
		margin-left: 15px;
		color: white;
		font-weight: bold;
		float: right;
		font-size: 22px;
		line-height: 20px;
		cursor: pointer;
		transition: 0.3s;
	}

	.closebtn:hover {
		color: black;
	}

	.buttones
	{
	    cursor:pointer;
	    font-size:18px;
	    font-weight:bold;
		padding-left:30px;
		padding-right:30px;
		padding-top:4px;
		padding-bottom:4px;
		border:solid 2px #FFF; 
		border-radius:25px;
		color:#FFFbc2;
		background-color:rgba(39, 39, 40, 0.8);
		transition-duration: 0.4s;
	}

	.buttones:hover
	{
		border:solid 2px #000; 
		color:#000;
		background-color:rgba(255, 255, 255, 0.8);
	}

	.footnotes
	{
		font-size:18px;
		color:#FFF;
	}

	.textboxx
	{
		padding-left:15px;
		padding-top:3px
		padding-bottom:3px;
		font-size:20px;
		border:solid 2px #FFF; 
		border-radius:5px;
		color:#FFFbc2;
		background-color:rgba(39, 39, 40, 0.8);
		transition-duration: 0.4s;
	}
	.textboxx:focus
	{

		outline:none;
		border:solid 2px #FFF; 
		border-radius:25px;
		color:#000;
		background-color:rgba(255, 255, 255, 0.8);
		transition-duration: 0.4s;
	}
	.textboxxx
	{
	    width:30%;
		padding-left:15px;
		font-size:17px;
		border:solid 2px #000; 
		border-radius:5px;
		color:#FFFbc2;
		background-color:rgba(255, 255, 255, 0.8);
		transition-duration: 0.4s;
	}
	.textboxxx:focus
	{

		outline:none;
		border:solid 2px #efe334; 
		border-radius:25px;
		color:#000;
		background-color:rgba(255, 255, 255, 0.8);
		transition-duration: 0.4s;
	}
	.selecta
	{
		padding:5px;
		border:solid 2px #FFF; 
		border-radius:5px;
		color:#FFFbc2;
		background-color:rgba(39, 39, 40, 0.8);
		transition-duration: 0.4s;
	}

	.checker
	{
		padding:5px;
		border:solid 2px #000; 
		border-radius:0px;
		color:#FFFbc2;
		background-color:rgba(39, 39, 40, 0.8);
		transition-duration: 0.4s;
		cursor:pointer;
		width:20px;
		height:20px;
	}
	
	.buttones2
	{
	    cursor:pointer;
	    font-size:18px;
		padding-left:30px;
		padding-right:30px;
		padding-top:4px;
		padding-bottom:4px;
		border:solid 2px #FFF; 
		border-radius:5px;
		color:#FFFbc2;
		background-color:rgba(76, 64, 60, 0.8);
		transition-duration: 0.4s;
		font-weight:bold;
	}

	.buttones2:hover
	{
		border:solid 2px #000; 
		color:#000;
		background-color:rgba(255, 255, 255, 0.8);
	}
	
		.buttones3
	{
	    cursor:pointer;
	    font-size:15px;
		padding-left:30px;
		padding-right:30px;
		padding-top:10px;
		padding-bottom:10px;
		border:solid 2px #FFF; 
		border-radius:5px;
		color:#FFFbc2;
		background-color:rgba(76, 64, 60, 0.8);
		transition-duration: 0.4s;
		font-weight:bold;
	}

	.buttones3:hover
	{
		border:solid 2px #000; 
		color:#000;
		background-color:rgba(255, 255, 255, 0.8);
	}
	
	.dropboxxx
	{
		padding-left:20px;
		height:50px;
		width:40%;
		border:solid 2px #FFF; 
		border-radius:5px;
		color:#FFFbc2;
		background-color:rgba(39, 39, 40, 0.8);
		transition-duration: 0.4s;
	}
	
	.dropboxxx:click
	{
		outline:none;
		border:solid 2px #FFF; 
		border-radius:25px;
		color:#000;
		background-color:rgba(255, 255, 255, 0.8);
		transition-duration: 0.4s;
	}
	
	.buttones3
	{
		padding-left:30px;
		padding-right:30px;
		padding-top:2px;
		padding-bottom:2px;
		border:solid 2px #FFF; 
		border-radius:5px;
		color:#FFFbc2;
		background-color:rgba(39, 39, 40, 0.8);
		transition-duration: 0.4s;
		font-weight:bold;
	}

	.buttones3:hover
	{
		border:solid 2px #FFF; 
		color:#000;
		background-color:rgba(255, 255, 255, 0.8);
	}
</style><br><p class="footnotes">&copy; 2017 Voltshop</p><br>
	</body>	<script src="../js/smoothscroll.js"></script>
</html>
      </div>
    </div>
  </div>
  <!-- Main Content -->

</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
