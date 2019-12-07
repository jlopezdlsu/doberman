<?php
session_start();
//edit_profile.php

include('conn.php');

if(isset($_POST['user_name']))
{
	$query = "
	UPDATE tbl_users SET
		username = '".$_POST["user_name"]."',
		firstName = '".$_POST["first_name"]."',
		lastName = '".$_POST["last_name"]."',
		address = '".$_POST["address"]."',
		emailAddress = '".$_POST["user_email"]."'
		WHERE userID = '".$_SESSION["userID"]."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	if(isset($result))
	{
		echo '<div class="alert alert-success">Profile Edited</div>';
	}
}

?>
