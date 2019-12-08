<?php include('server.php') ?>
<!DOCTYPE html>
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
	<style media="screen">
	.login-container{
		margin-top: 5%;
		margin-bottom: 5%;
	}
	.login-form-1{
		padding: 5%;
		box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
	}
	.login-form-1 h3{
		text-align: center;
		color: #333;
	}
	.login-form-2{
		padding: 5%;
		background: #0062cc;
		box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
	}
	.login-form-2 h3{
		text-align: center;
		color: #fff;
	}
	.login-container form{
		padding: 10%;
	}
	.btnSubmit
	{
		width: 50%;
		border-radius: 1rem;
		padding: 1.5%;
		border: none;
		cursor: pointer;
	}
	.login-form-1 .btnSubmit{
		font-weight: 600;
		color: #fff;
		background-color: #0062cc;
	}
	.login-form-2 .btnSubmit{
		font-weight: 600;
		color: #0062cc;
		background-color: #fff;
	}
	.login-form-2 .ForgetPwd{
		color: #fff;
		font-weight: 600;
		text-decoration: none;
	}
	.login-form-1 .ForgetPwd{
		color: #0062cc;
		font-weight: 600;
		text-decoration: none;
	}
	.error{
		color: red;
		font-weight: bold;
	}
	</style>
</head>

<body>

	<?php include('header.php') ?>

  <div class="section" style="margin-top:100px">
		<div class="container login-container">
			<div class="row">
				<div class="offset-3 col-lg-6 login-form-1">
					<div class="header">
						<h2 style="text-align:center">Register</h2>
					</div>
					<form method="post" action="register.php">
						<?php include('errors.php'); ?>
						<div class="form-group">
							<input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" class="form-control">
						</div>
						<div class="form-group">
							<input type="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>" class="form-control">
						</div>
						<div class="form-group">
							<input type="password" name="password_1" placeholder="Password" class="form-control">
						</div>
						<div class="form-group">
							<input type="password" name="password_2" placeholder="Confirm Password" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary float-right" value="Register" name="reg_user"/>
						</div>
						<div class="form-group">
							<p>
								Already registered? <a href="login.php">Log In</a>
							</p>
						</div>
					</form>
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
