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
  <?php include('header.php') ?>


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

      if(isset($_POST['btnAddMenu'])){
        $itemName1 = $_POST['txtName1'];
        $itemDesc = $_POST['txtDescription'];
        $itemPrice = $_POST['txtPrice'];
		 $itemSpecs = $_POST['txtSpecs'];
        $itemCategory = $_POST['category'];
        $itemDiscount = $_POST['txtDiscount'];
		 $itemDesc2 = $_POST['txtDescription2'];

        $itemDate = date('Y/m/d A H:i:s');
 
        $itemQty = $_POST['txtQty'];
		
        $itemsku = $_POST['sku'];

        $target_dir = "themes/images/products/";
        $target_file = $target_dir . basename($_FILES["fileImage"]["name"]);	
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $imageSrc = "themes/images/products/".$_POST['txtName1'].".".$imageFileType; // Image src for database
        $fileName = $target_dir.$_POST['txtName1'].".".$imageFileType;
        $check = getimagesize($_FILES["fileImage"]["tmp_name"]); // Returns false if file is not image
		
		      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG and PNG files are allowed.";
          } 
          else if($check == false) {
            echo "<center><div class='alert'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
              Invalid image file.
            </div>";
          }
          else {
            if (file_exists("$fileName")) unlink("$fileName");
            if (move_uploaded_file($_FILES["fileImage"]["tmp_name"], $fileName)) {
				$sql="INSERT INTO `additem` (`ItemName`,`shortDesc`,`price`,`specs`,`category`,`discount`,`imgsrc`,`description`,`qty`,`sku`) VALUES ('$itemName1','$itemDesc','$itemPrice','$itemSpecs','$itemCategory','$itemDiscount','$imageSrc','$itemDesc2','$itemQty','$itemsku');";
			  if($conn->query($sql)){
              echo "<center><div class='alert success'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
			Item has successfully been added.
			</div>";
					$conn->close();
				}else{
              echo "<center><div class='alert success'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
			".$conn->error."
			</div>";
					$conn->close();
				}
              
            } else {
              echo "<center><div class='alert warning'><span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
			Error uploading image.
			</div>";
            }  
          }
        }
        ob_end_flush();
   
   ?>


    <form name="addmenuForm" action="additemnaz.php" method="post" enctype="multipart/form-data">
      <table  border=0 align=center width="40%" style="box-shadow: 10px 10px 10px 10px #000; font-size:20px;background-color:rgba(255,255,255,0.8);">
        <tr><td  colspan=2 style="background-color:#353638; padding-bottom:10px;padding:20px;"><h1 style="color:#f7efc0;" align="center">Dobermann Add Item</h1></td></tr>
        <tr>
          <td style="padding-left:20px;"> <br>Item Name: </td>
          <td><br><input type="text" class="texto"required name="txtName1" maxlength="30"></td>
        </tr>
		  <tr>
          <td style="padding-left:20px;"> <br>Stock Keeping Unit (SKU): </td>
          <td><br><input type="text" class="texto"required name="sku" maxlength="30"></td>
        </tr>
        <tr>
          <td style="padding-left:20px;">Short Description: </td>
          <td><input type="text" class="texto" required name="txtDescription"></td>
        </tr>
        <tr>
          <td style="padding-left:20px;">Price: ₱ </td>
          <td><input type="number" class="texto" required name="txtPrice"></td>
        </tr>
        <tr>
          <td style="padding-left:20px;">Specification: </td>
          
<td><textarea  id="txtSpecs" class ="texto"required name= "txtSpecs" style="height:220px;width:250px;"> </textarea></td>
        </tr>
        <tr>
          <td style="padding-left:20px; font-size:20px;"><br>Merchant Name: </td>
          <td><br><select name="category">
              <option value="Camera">Camera</option>
              <option value="Computers, Tablets & Laptops">Computers, Tablets & Laptops</option>
              <option value="Mobile Phone">Mobile Phone</option>
              <option value="Storage Devices">Storage Devices</option>
              <option value="Sound & Vision">Sound & Vision</option>
              </select>
          </td>
        </tr>
        <tr>
          <td style="padding-left:20px;"><br>Discount: </td>
          <td><br><input type="text" class="texto" required name="txtDiscount"></td>
        </tr>
        <tr>
          <td style="padding-left:20px;cursor:pointer;"><br>Image:<br></td>
          <td><br><input type="file" name="fileImage" id="fileImage" accept=".png, .jpg, .jpeg" required><br></td>
        </tr>
        <tr>
          <td style="padding-left:20px;"><br>Description:<br></td>
   <td><textarea id = ""required name="txtDescription2" style="height:220px;width:250px;"> </textarea></td>
        </tr>
        <tr>
          <td style="padding-left:20px;">Qty: </td>
          <td><br><input type="text" class="texto" required name="txtQty"><br><br></td>
        </tr>
        
        <tr style="margin-top:20px;background-color:#353638;">
          <td colspan=2 align=center><br><input class="buttones" type="submit" name="btnAddMenu" value="Add to Menu"><br><br></td>
        </tr>
      </table>
    </form>	<br><center>
	<p class="footnotes">&copy; 2019 DoberMann</p><br><br>
  </body>



	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic|Merriweather:300,400italic,300italic,400,700italic' rel='stylesheet' type='text/css'>

	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">

	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">

	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="../css/simple-line-icons.css">

	<!-- Datetimepicker -->
	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css">

	<!-- Flexslider -->
	<link rel="stylesheet" href="../css/flexslider.css">

	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/cart.css">

	<!-- Modernizr JS -->
	<script src="../js/modernizr-2.6.2.min.js"></script>

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


      </div>
    </div>
  </div>
  <!-- Main Content -->
  <?php include('footer.php') ?>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
