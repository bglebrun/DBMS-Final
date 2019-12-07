<?php
    # Debug php install
    # phpinfo();
    require "config.php";

    try {
        $conn = new PDO("mysql:host=$servername", $username, $password, $options);
        $sql = file_get_contents("sql/init.sql");
        $conn->exec($sql);
    
        echo "Db and users created successfully.";
    }

    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

?>