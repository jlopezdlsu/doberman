<?php

if(isset($_SESSION['username']) && isset($_SESSION['success']))
{?>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom box-shadow fixed-top">
    <div class="container">
      <div class="row">
        <h3 class="my-0 mr-md-auto font-weight-normal col-lg-2">
          <a href="index.php">
            <img src="assets/images/doberman.png" alt="" style="width:50%">
          </a>
        </h3>
        <nav class="navbar my-2 my-md-0 mr-md-3 p-0">
          <a class="p-2 text-dark" href="allproducts.php">Products</a>
          <a class="p-2 text-dark" href="help.php">Help</a>
          <a class="p-2 text-dark" href="contact.php">Contact Us</a>
          <a class="p-2 text-dark" href="my-cart.php"> <i class="fa fa-shopping-cart"></i></a>
          <li class="nav-item dropdown text-dark" style="list-style:none;">
            <a class="nav-link dropdown-toggle  text-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hi <?php echo $_SESSION['username'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="profile.php">Profile</a>
              <a class="dropdown-item" href="changePassword.php">Change Password</a>
              <a class="dropdown-item" href="history.php">Transaction History</a>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </li>
        </nav>
      </div>
    </div>
  </div>
  <?php
}
else{
  ?>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom box-shadow fixed-top">
    <div class="container">
      <div class="row">
        <h3 class="my-0 mr-md-auto font-weight-normal">
          <a href="index.php">Doberman</a>
        </h3>
        <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-dark" href="allproducts.php">Products</a>
          <a class="p-2 text-dark" href="help.php">Help</a>
          <a class="p-2 text-dark" href="contact.php">Contact Us</a>
          <a class="p-2 text-dark" href="login.php">Login</a>
          <a class="p-2 text-dark" href="register.php">Sign Up</a>
        </nav>
      </div>
    </div>
  </div>
  <?php
}
?>
