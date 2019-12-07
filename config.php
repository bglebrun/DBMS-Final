<?php

    /**
     * Configuration for database connection
    *
    */

    $servername = "localhost";
    $username   = "bglebrun";
    $password   = "password";
    $dbname     = "test"; // will use later
    $port       = 3306;
    $dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
    $options    = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );
?>