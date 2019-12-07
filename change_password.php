<?php
session_start();
//edit_profile.php

include('conn.php');

if(isset($_POST['user_name']))
{
	if($_POST["user_new_password"] != '')
	{
		$query = "
		UPDATE tbl_users SET
			password = '".md5($_POST["user_new_password"])."'
			WHERE userID = '".$_SESSION["userID"]."'
		";
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	if(isset($result))
	{
		echo '<div class="alert alert-success">Password Edited</div>';
	}
}

?>
