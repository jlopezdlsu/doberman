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
</head>

<body>
  <script
  src="https://www.paypal.com/sdk/js?client-id=AQh6WOvdT57cij6FGemJZqkOpXzCtYPW-Zhmjjqsmm_PfgZg60jhHzRAaxEF0S28cTrsMSq9KmjzSv_D&currency=PHP"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>
	<?php include('header.php') ?>

  <div class="section" style="margin-top:100px">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header">
            <h2>Doberman Register</h2>
          </div>
        </div>

        <form method="post" action="register.php">
          <?php include('errors.php'); ?>
          <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
          </div>
          <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
          </div>
          <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
          </div>
          <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2">
          </div>

          <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
          </div>
          <p>
            Already a member? <a href="login.php">Sign in</a>
          </p>
        </form>
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
