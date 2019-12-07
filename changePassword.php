<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Edit Profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="js/jquery-1.10.2.min.js"></script>
	<link href="css/style.css" rel="stylesheet">
</head>

<body>


<?php
//profile.php

session_start();
include('conn.php');

$query = "
SELECT * FROM tbl_users
WHERE userID = '".$_SESSION["userID"]."'
";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$name = '';
$fname = '';
$lname = '';
$addr = '';
$email = '';
$user_id = '';
foreach($result as $row)
{
	$name = $row['username'];
	$fname = $row['firstName'];
	$lname = $row['lastName'];
	$addr = $row['address'];
	$email = $row['emailAddress'];
}

include('header.php');
?>

<div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header">
		<div class="panel panel-default" style="padding-top:100px;">
			<h4 class="box-title"><b>Change Password</b></h4>
			<div class="panel-body">
				<form method="post" id="edit_profile_form">
					<span id="message"></span>
					<div class="form-group">
						<input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $result[0]['username']; ?>" required hidden />
					</div>
					<div class="form-group">
						<label>New Password</label>
						<input type="password" name="user_new_password" id="user_new_password" class="form-control" />
					</div>
					<div class="form-group">
						<label>Re-enter Password</label>
						<input type="password" name="user_re_enter_password" id="user_re_enter_password" class="form-control" />
						<span id="error_password"></span>
					</div>
					<div class="form-group float-right">
						<input type="submit" name="edit_profile" id="edit_profile" value="Edit" class="btn btn-info" />
					</div>
				</form>
			</div>
		</div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
	$('#edit_profile_form').on('submit', function(event){
		event.preventDefault();
		if($('#user_new_password').val() != '')
		{
			if($('#user_new_password').val() != $('#user_re_enter_password').val())
			{
				$('#error_password').html('<label class="text-danger">Password Not Match</label>');
				return false;
			}
			else
			{
				$('#error_password').html('');
			}
		}
		$('#edit_profile').attr('disabled', 'disabled');
		var form_data = $(this).serialize();
		$('#user_re_enter_password').attr('required',false);
		$.ajax({
			url:"change_password.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#edit_profile').attr('disabled', false);
				$('#user_new_password').val('');
				$('#user_re_enter_password').val('');
				$('#message').html(data);
			}
		})
	});
});
</script>

<?php include('footer.php'); ?>
</body>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery-ui.js"></script>
</html>
