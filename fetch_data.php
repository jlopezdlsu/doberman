<?php

//fetch_data.php

include('db.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM product WHERE prd_status = '1'
	";
	
	if(isset($_POST["search_query"]) && $_POST["search_query"] !== "")
	{
		$catsearch=  $_POST["search_query"];
		$query .= "
		 AND prd_cat LIKE '".$catsearch."'";
	}
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND prd_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["category"]))
	{
		$cat_filter = implode("','", $_POST["category"]);
		$query .= "
		 AND prd_cat IN('".$cat_filter."')
		";
	}
	
	if(isset($_POST["brand"]))
	{
		$brand_filter = implode("','", $_POST["brand"]);
		$query .= "
		 AND prd_brand IN('".$brand_filter."')
		";
	}
	if(isset($_POST["ram"]))
	{
		$ram_filter = implode("','", $_POST["ram"]);
		$query .= "
		 AND prd_ram IN('".$ram_filter."')
		";
	}
	if(isset($_POST["storage"]))
	{
		$storage_filter = implode("','", $_POST["storage"]);
		$query .= "
		 AND prd_storage IN('".$storage_filter."')
		";
	}

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<div class="col-sm-4 col-lg-3 col-md-3">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:400px;">
					<img src="image/'. $row['prd_image'] .'" alt="" class="img-responsive" >
					<p align="center"><strong><a href="#">'. $row['prd_name'] .'</a></strong></p>
					<h4 style="text-align:center;" class="text-danger" >₱'. $row['prd_price'] .'</h4>
				</div>
			</div>
			';
		}
	}
	else
	{
		$output = '<center><h3>No Data Found</h3></center>';
	}
	echo $output;
}

//'.$query.'
?>