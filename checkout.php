<?php

//header.php

//include "header.php";
include ('conn.php');
include ('fetch_data.php');

?>
<!-- /BREADCRUMB -->

<script type="text/javascript">
jQuery(document).ready(function($) {
	$(".scroll").click(function(event){
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
	});
});
</script>

<script>

(function (global) {
	if(typeof (global) === "undefined")
	{
		throw new Error("window is undefined");
	}
	var _hash = "!";
	var noBackPlease = function () {
		global.location.href += "#";
		// making sure we have the fruit available for juice....
		// 50 milliseconds for just once do not cost much (^__^)
		global.setTimeout(function () {
			global.location.href += "!";
		}, 50);
	};
	// Earlier we had setInerval here....
	global.onhashchange = function () {
		if (global.location.hash !== _hash) {
			global.location.hash = _hash;
		}
	};
	global.onload = function () {
		noBackPlease();
		// disables backspace on page except on input fields and textarea..
		document.body.onkeydown = function (e) {
			var elm = e.target.nodeName.toLowerCase();
			if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
				e.preventDefault();
			}
			// stopping event bubbling up the DOM tree..
			e.stopPropagation();
		};
	};
})(window);
</script>

<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Specific Product</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href="css/jquery-ui.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>

<body>
  <script
  src="https://www.paypal.com/sdk/js?client-id=AQh6WOvdT57cij6FGemJZqkOpXzCtYPW-Zhmjjqsmm_PfgZg60jhHzRAaxEF0S28cTrsMSq9KmjzSv_D&currency=PHP"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>
	<?php include('header.php') ?>

  <div class="section" style="margin-top:100px">
    <div class="container">
      <div class="row">
        <?php
        $query = $connect->prepare("SELECT product.productID,product.productName, product.quantity, product.price, product.ram, product.storage, product.camera, product.processor, product.description, product.shortDescription, category.categoryID, product.categoryID, category.categoryName  FROM tbl_product product INNER JOIN tbl_category category ON category.categoryID = product.categoryID WHERE productID = :product_id");
				$query->execute(['product_id' => $_GET['p']]);
        while ($row = $query->fetch()){
          $productName = $row['productName'];
          $price = $row['price'];
          $description = $row['description'];
          $price = $row['price'];
            $subtotal = 1 * $price;
            $total = $subtotal;
            $productID = $row['productID'];
        }
         ?>
        <div class="col-lg-12">
                  <div class="card">
                      <div class="card-header">
                         <b> My Cart Detail </b>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive-lg">
                              <table class="table v-set">
                                  <thead>
                                      <tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Product</th>
                                          <th scope="col">Detail</th>
                                          <th scope="col">Quantity</th>
                                          <th scope="col">Price</th>
                                          <th scope="col">Subtotal</th>
                                          <th scope="col">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>
                                              <img src="" class="box-image-set-2">
                                          </td>
                                          <td><img src="image/<?php getImage($productID,$connect) ?>" alt=""></td>
                                          <td><?php echo $productName; ?></td>
                                          <td><?php echo $description; ?></td>
                                          <td>1</td>
                                          <td><?php echo $price; ?></td>
                                          <td><?php echo $subtotal; ?></td>
                                          <td>
                                              <button class="btn btn-sm btn-danger rm-val">
                                                  <span><i class="far fa-trash-alt"></i></span>
                                                  <span>Remove</span>
                                              </button>
                                          </td>
                                      </tr>

                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <td colspan="6"><b> Total Amount : </b> </td>
                                          <td><?php echo $total; ?></td>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                      </div>


                  </div>
              </div>
      </div>
      <div class="row pt-3">
        <div class="col-lg-9">

        </div>
        <div class="col-lg-3">
          <div id="paypal-button-container"></div>
        </div>
      </div>
    </div>
  </div>

	<!-- FOOTER -->
	<?php include('footer.php') ?>
</body>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery-ui.js"></script>
</html>
<!-- Load the required checkout.js script -->

  <script>
    paypal.Buttons({
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '5000'
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          alert('Transaction completed by ' + details.payer.name.given_name);
          // Call your server to save the transaction
          return fetch('/paypal-transaction-complete', {
            method: 'post',
            headers: {
              'content-type': 'application/json'
            },
            body: JSON.stringify({
              orderID: data.orderID
            })
          });
        });
      }
    }).render('#paypal-button-container');
  </script>
