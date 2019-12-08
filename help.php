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
            <h5 class="box-title"><b>Frequently Asked Questions</b></h5>

          </div>
        </div>
      </div>
      <div class="col-md-12 mt-3 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s">
        <div class="col-md-9 deck help-main" >
          <div>
            <ul class="ul-help">
              <li><h5><div id="flip" onclick="showDivForFQA(this.id)"> <i class="fa fa-chevron-circle-down" aria-hidden="true"></i> How to Log In?</div></h5></li>
              <div id="panel">
                <b>1. At the top of every page, you can locate the navigation bar which you can use to navigate the website to different pages. </b>
                <p>You can see there the Log In navigation.</p>
                <img src="assets/images/help/1.jpg" style="width:40%;"><br>
                <b>2. Click on Log In</b>
                <p>Fill up the correct username and password. If you want the computer to remember your account, click remember me. To finish the process, click Log In.</p>
                <img src="assets/images/help/2.jpg" style="width:100%;">
              </div>
              <li><h5><div id="flip1" onclick="showDivForFQA(this.id)"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> How to Log Out?</div></h5></li>
              <div id="panel1">
                <p><i>When you're using a public computer, remember that you may still be signed in to any services you’ve been using even after you close the browser. So when using a public computer, be sure to sign out.</i></p>
                <b>1. In the most upper right corner of the navigation bar, you can see the different actions you can do with .</b>
                <p>Click on Settings.</p>
                <img src="assets/images/help/3.jpg" style="width:50%;"><br>
                <b>2. Navigate the Account Settings and locate the sign out button.</b>
                <p>Click Sign Out.</p>
                <img src="assets/images/help/4.jpg" style="width:50%;">
              </div>

              <li><h5><div id="flip3" onclick="showDivForFQA(this.id)"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> How to Register?</div></h5></li>
              <div id="panel3">
                <b>1. At the top of every page, you can locate the navigation bar which you can use to navigate the website to different pages. </b>
                <p>Click Sign Up.</p>
                <img src="assets/images/help/1.jpg" style="width:40%;"><br>
                <b>2. Registration Form</b>
                <p>Fill up all the fileds in the registration form and once you're done, click on the checkmark if you agree with the terms and conditions of .</p>
                <p>Click the <b>Submit</b> button </p>
                <img src="assets/images/help/5.jpg" style="width:50%;"><br><br>
                <b>3. A prompt message will pop up indicating that you're registration is a success.</b>
                <p>Read the details indicated and sign in to your email address used in registering with .</p>
                <img src="assets/images/help/6.jpg" style="width:50%;"><br><br>
                <b>4. Open the Email sent by  to verify your account.</b>
                <p>Click the link in the Email.</p>
                <img src="assets/images/help/7.jpg" style="width:50%;">
              </div>

              
            </ul>

          </div>
        </div>
      </div>

    </div>

  </div>

</div>
</div>


<?php include('footer.php'); ?>
</body>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh5U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="js/jquery-ui.js"></script>
<script type="text/javascript">
function showDivForFQA(id){
  if(id == 'flip'){
    $("#panel").slideToggle('slow');
  }
  else{
    callBack(id.split("flip")[1]);
    $("#panel"+id.split("flip")[1]).slideToggle('slow');
  }
}
function callBack(i){
  for(var j=0;j<8;j++){
    if(j != i){
      if($("#panel" + (j == 0 ? "" : j)).is(':visible')){
        $("#panel"+ (j == 0 ? "" : j)).slideToggle('slow');
      }
    }
  }
}

</script>
</html>
