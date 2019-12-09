<?php require "boilerplates/header.php" ?>

<?php
    require "config.php";
    require "common.php";

    try {
        $conn = new PDO($dsn, $username, $password, $options);
        echo "<h2>Connected successfully</h2>";
    }
    catch(PDOException $e) {
        echo "<h2>Connection failed: " . $e->getMessage() . "</h2>";
    }
?>

<?php require "boilerplates/footer.php" ?>