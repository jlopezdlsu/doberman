<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array();
// connect to the database
   $db = mysqli_connect('localhost', 'root', '', 'db_doberman2');
  //$db = mysqli_connect('35.240.223.49:3306', 'dobermandb', 'wKue77tk0ovftrik', 'db_doberman');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $userType = "2";
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required."); }
  if (empty($email)) { array_push($errors, "Email is required."); }
  if (empty($password_1)) { array_push($errors, "Password is required."); }
  if (empty($userType)) {array_push($errors, "Role is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM tbl_users WHERE username='$username' OR emailAddress='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists.");
    }
    if ($user['email'] === $email) {
      array_push($errors, "Email already exists.");
    }
  }
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
  	$query = "INSERT INTO tbl_users (username, emailAddress, password, userType)
  			  VALUES('$username', '$email', '$password', '$userType')";

  	if(mysqli_query($db, $query)){
    $_SESSION['userID'] = mysqli_insert_id($db);
  	$_SESSION['username'] = $username;
    $_SESSION['role'] = $userType;
  	$_SESSION['success'] = "You have successfully registered";
  	header('Location: index.php');
  }
  else {
    echo mysqli_error($db);
  }
  }
  else {
    echo mysqli_error($db);
  }
}
// ...
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  if (empty($username)) {
    array_push($errors, "Username is required.");
  }
  if (empty($password)) {
    array_push($errors, "Password is required.");
  }
  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password' AND userType = '2'";
    $results = mysqli_query($db, $query);
    $get_info = mysqli_fetch_assoc($results);

    if (mysqli_num_rows($results) == 1) {
      $_SESSION['userID'] = $get_info['userID'];
      $_SESSION['username'] = $username;
      $_SESSION['role'] = $get_info['userType'];
      $_SESSION['success'] = "You are now logged in.";
      if(isset($_SESSION['LOGIN_REFERRED']) && $_SESSION['LOGIN_REFERRED']){
        header("Location:". $_SESSION['LOGIN_REFERRED']);
        $_SESSION['LOGIN_REFERRED'] = null;
      }else{
        header('location: index.php');
      }
    }else {
      array_push($errors, "Wrong username/password combination.");
    }
  }
}

?>
