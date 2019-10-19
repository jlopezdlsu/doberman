<?php

//db.php

//$connect = new PDO("mysql:host=localhost;dbname=product", "root", "");

require_once 'dbconfig.php';
 
$dsn= "mysql:host=$host;dbname=$db";
 
//create a PDO connection with the configuration data from dbconfig.php
$connect = new PDO($dsn, $username, $password);
 
 
?>