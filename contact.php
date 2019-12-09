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

  include('header.php');
  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="header">
          <div class="panel panel-default" style="padding-top:100px;">
            <h4 class="box-title"><b>Contact Us</b></h4>

          </div>
        </div>
      </div>
      <div class="col-md-6 mt-3 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s">
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content.</p>

                <div class="find-widget">
                 Company:  <a href="#">Doberman</a>
                </div>
                <div class="find-widget">
                 Address: <a href="#">2401 Taft Ave, Malate, Manila, 1004 Metro Manila</a>
                </div>
                <div class="find-widget">
                  Phone:  <a href="#">(02) 8524 4611</a>
                </div>

                <div class="find-widget">
                  Website:  <a href="#">www.doberman.com</a>
                </div>

              </div>
              <!-- contact form -->
              <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.6021494227457!2d120.99099291483982!3d14.564729389825354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c97ed286459b%3A0x5927068d997eae2a!2sDe%20La%20Salle%20University%20Manila!5e0!3m2!1sen!2sph!4v1575783871970!5m2!1sen!2sph" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
              </div>
    </div>
  </div>


  <?php include('footer.php'); ?>
</body>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="js/jquery-ui.js"></script>
</html>
