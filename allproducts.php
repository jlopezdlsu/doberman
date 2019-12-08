<?php include('server.php') ?>

<?php
include('conn.php'); //Database Connection
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Product Filter</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="css/jquery-ui.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>

<body>
  <?php include('header.php') ?>
  <!-- Page Content -->
  <div class="container pt-5">

    <br/>
    <br/>
    <div align="right" class="top_search">
      <input type="text" class="search_input form-control " id="search_query" name="search_query" placeholder="Advanced Search" style="width:80%;float:left"/>
      <input id="search_button" type="button" value="Search" class="search_bt btn btn-primary" name="search" style="width:18%;float:left;margin-left:10px"/>
    </div>
    <br/>
    <br/>

    <br/>
    <br/>

    <div class="row">
      <div class="col-md-3">
        <div class="list-group">
          <h3>Price</h3>
          <input type="hidden" id="min_price_hide" value="0" />
          <input type="hidden" id="max_price_hide" value="2000" />
          <p id="price_show">PHP 100 - PHP 2000</p>
          <div id="price_range"></div>
        </div>

        <div class="list-group">
          <h3>Category</h3>
          <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
            <?php
            $query = "SELECT * FROM tbl_category ORDER BY categoryName ASC";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $row)
            {
              ?>
              <div class="list-group-item checkbox">
                <label>
                  <input type="checkbox" class="filter_all category" value="<?php echo $row['categoryID']; ?>">
                  <?php echo $row['categoryName']; ?>
                </label>
              </div>
              <?php
            }
            ?>
          </div>
        </div>

        <div class="list-group">
          <h3>Brand</h3>
          <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
            <?php

            $query = "SELECT * FROM tbl_brand ORDER BY brandName ASC";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $row)
            {
              ?>
              <div class="list-group-item checkbox">
                <label>
                  <input type="checkbox" class="filter_all brand" value="<?php echo $row['brandID']; ?>">
                  <?php echo $row['brandName']; ?>
                </label>
              </div>
              <?php
            }

            ?>
          </div>
        </div>

        <div class="list-group">
          <h3>RAM</h3>
          <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
            <?php

            $query = "
            SELECT * FROM tbl_product WHERE ram <> '0' AND status = '1' ORDER BY ram DESC
            ";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $row)
            {
              ?>
              <div class="list-group-item checkbox">
                <label>
                  <input type="checkbox" class="filter_all ram" value="<?php echo $row['ram']; ?>">
                  <?php echo $row['ram']; ?>
                </label>
              </div>
              <?php
            }

            ?>
          </div>
        </div>

        <div class="list-group">
          <h3>Internal Storage</h3>
          <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
            <?php
            $query = "
            SELECT * FROM tbl_product WHERE storage <> '0' AND status = '1' ORDER BY storage DESC
            ";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $row)
            {
              ?>
              <div class="list-group-item checkbox">
                <label><input type="checkbox" class="filter_all storage" value="<?php echo $row['storage']; ?>"  > <?php echo $row['storage']; ?> GB</label>
              </div>
              <?php
            }
            ?>
          </div>
        </div>


      </div>

      <div class="col-md-9">

        <div class="row filter_data">

        </div>

      </div>
    </div>

  </div>
  <?php include('footer.php') ?>
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="js/jquery-ui.js"></script>

  <script>
  $(document).ready(function() {

    filter_data();

    function filter_data() {
      $('.filter_data');
      var action = 'fetch_data';
      var search_query = $('#search_query').val();
      var minimum_price = $('#min_price_hide').val();
      var maximum_price = $('#max_price_hide').val();
      var category = get_filter('category');
      var brand = get_filter('brand');
      var ram = get_filter('ram');
      var storage = get_filter('storage');
      $.ajax({
        url: "fetch_data.php",
        method: "POST",
        data:{action:action, search_query:search_query, minimum_price:minimum_price, maximum_price:maximum_price, category:category, brand:brand, ram:ram, storage:storage},
        success: function(data) {
          $('.filter_data').html(data);
        }
      });
    }

    function get_filter(class_name) {
      var filter = [];
      $('.' + class_name + ':checked').each(function() {
        filter.push($(this).val());
      });
      return filter;
    }

    $('.filter_all').click(function() {
      filter_data();
    });

    $('#price_range').slider({
      range:true,
      min:100,
      max:2000,
      values:[100, 2000],
      step:10,
      stop: function(event, ui) {
        $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
        $('#min_price_hide').val(ui.values[0]);
        $('#max_price_hide').val(ui.values[1]);
        filter_data();
      }
    });

    $("#search_button").click(function(){
      filter_data();
    });

  });
  </script>

</body>

</html>
