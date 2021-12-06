<?php
  $dbhost= "localhost";
  $dbname = "soup.kitchen";
  $dbusername= "root";
  $dbpassword = "gwinifred20";
  
  $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


?>