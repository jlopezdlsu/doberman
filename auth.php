<?php session_start();

if ( !isset( $_SESSION['username'] ) && !isset($_SESSION['success'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
     header("Location: login.php");
  }
// else {
//     // Redirect them to the login page
//     header("Location: login.php");
// }

?>
