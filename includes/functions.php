<?php

// database connection function
function db_connect() {
  $db = parse_ini_file("config-sample.ini");
  $dbhost = $db['dbhost'];
  $dbname = $db['dbname'];
  $dbuser = $db['dbuser'];
  $dbpass = $db['dbpass'];
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
  return $dbconn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, $options);
}

?>