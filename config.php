<?php

/**
  * Configuration for database connection
  *
  */

$servername       = "localhost";
$username   = "username";
$password   = "password";
$dbname     = "test"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
?>