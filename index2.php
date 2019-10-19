<?php 

//index.php

include('db.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  
  <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
  <title></title>
</head>
<body class="pt-3">
  <?php include('header.php') ?>


  <!-- Main Content -->
  <div class="container containerBody" >
    <div class="row">
      <div class="col-lg-12">
        <div id="form">
  
  <!--<form method="get"  enctype="multipart/form-data">-->
  
  
    <div align="right" class="top_search">
      <input type="text" class="search_input" id="search_query" name="search_query" placeholder="Advanced Search"/>
      <input id="search_button" type="button" value="Search" class="search_bt" name="search"/>
    </div>
    
    
    <!--</form>-->
    <!-- Page Content -->
    <div class="container">
        <div class="row">
        	<br />
        	<!-- <h2 align="center">Advance Search Filter</h2> -->
        	<br />
            <div class="col-md-3">                				
				<div class="list-group">
					<h3>Price</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">1000 - 150000</p>
                    <div id="price_range"></div>
                </div>
				
				<div class="list-group">
					<h3>Category</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT(prd_cat) FROM product WHERE prd_status = '1' ORDER BY prd_cat ASC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector category" value="<?php echo $row['prd_cat']; ?>"  > <?php echo $row['prd_cat']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>
				
				
				
                <div class="list-group">
					<h3>Brand</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT(prd_brand) FROM product WHERE prd_status = '1' ORDER BY prd_brand ASC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector brand" value="<?php echo $row['prd_brand']; ?>"  > <?php echo $row['prd_brand']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

				<div class="list-group">
					<h3>RAM</h3>
                    <?php

                    $query = "
                    SELECT DISTINCT(prd_ram) FROM product WHERE prd_ram <> '0' AND prd_status = '1'ORDER BY prd_ram DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $row['prd_ram']; ?>" > <?php echo $row['prd_ram']; ?> GB</label>
                    </div>
                    <?php    
                    }

                    ?>
                </div>
				
				<div class="list-group">
					<h3>Internal Storage</h3>
					<?php
                    $query = "
                    SELECT DISTINCT(prd_storage) FROM product WHERE prd_storage <> '0' AND prd_status = '1' ORDER BY prd_storage DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector storage" value="<?php echo $row['prd_storage']; ?>"  > <?php echo $row['prd_storage']; ?> GB</label>
                    </div>
                    <?php
                    }
                    ?>	
                </div>
            </div>

            <div class="col-md-9">
            	<br />
                <div class="row filter_data">
					
                </div>
            </div>
        </div>

    </div>
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

			<script>
			$(document).ready(function(){

				filter_data();

				function filter_data()
				{
					$('.filter_data').html('<div id="loading" style="" ></div>');
					var action = 'fetch_data';
					var search_query = $('#search_query').val();
					var minimum_price = $('#hidden_minimum_price').val();
					var maximum_price = $('#hidden_maximum_price').val();
					var category = get_filter('category');
					var brand = get_filter('brand');
					var ram = get_filter('ram');
					var storage = get_filter('storage');
					$.ajax({
						url:"fetch_data.php",
						method:"POST",
						data:{action:action, search_query:search_query, minimum_price:minimum_price, maximum_price:maximum_price, category:category, brand:brand, ram:ram, storage:storage},
						success:function(data){
							$('.filter_data').html(data);
						}
					});
				}

				function get_filter(class_name)
				{
					var filter = [];
					$('.'+class_name+':checked').each(function(){
						filter.push($(this).val());
					});
					return filter;
				}

				$('.common_selector').click(function(){
					filter_data();
				});

				$('#price_range').slider({
					range:true,
					min:1000,
					max:150000,
					values:[1000, 150000],
					step:500,
					stop:function(event, ui)
					{
						$('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
						$('#hidden_minimum_price').val(ui.values[0]);
						$('#hidden_maximum_price').val(ui.values[1]);
						filter_data();
					}
				});
				
				$("#search_button").click(function(){
					filter_data();
				});

			});
			</script>
      </div>
    </div>
  </div>
  <!-- Main Content -->
  <?php include('footer.php') ?>
</body>
</html>
<!-- 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
-->