<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['success']))
{?>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom box-shadow fixed-top">
    <div class="container">
      <div class="row">
        <h3 class="my-0 mr-md-auto font-weight-normal">
          <a href="index.php">Doberman</a>
        </h3>
        <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-dark" href="allproducts.php">Products</a>
          <a class="p-2 text-dark" href="#">Help</a>
          <a class="p-2 text-dark" href="#">Contact Us</a>
          <a class="p-2 text-dark" href="#">Hi <?php echo $_SESSION['username'] ?></a>
          <a class="p-2 text-dark" href="my-cart.php"> <i class="fa fa-shopping-cart"></i></a>
          <a class="p-2 text-dark" href="logout.php">Logout</a>
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
          <a class="p-2 text-dark" href="#">Help</a>
          <a class="p-2 text-dark" href="#">Login</a>
          <a class="p-2 text-dark" href="#">Sign Up</a>
        </nav>
      </div>
    </div>
  </div>
  <?php
}
?>
