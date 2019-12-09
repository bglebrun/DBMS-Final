<?php include "boilerplates/header.php"; ?><h2>Register Student</h2>

    <form method="post" action="createStudent.php">

    <?php 
        require "config.php";
        $conn = new mysqli($host, $username, $password, $dbname, $port)
            or die ('Could not connect to the database server' . mysqli_connect_error());
    
        if(isset($_POST['submit'])) {
            $FName = $_POST['FName'];
            $LName = $_POST['LName'];


            $sql = "INSERT INTO students ( FName, LName ) VALUES ( '$FName' , '$LName' );";

            $results = $conn->query($sql);
            $message = "Successfully registered student";
        } 
    ?>

    	<label for="FName">First Name</label>
    	<input type="text" name="FName" id="FName">
    	<label for="LName">Last Name</label>
    	<input type="text" name="LName" id="LName">
    	<input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['message'])) {
        echo "<br><br>$message";
    }
    ?>

<?php include "boilerplates/footer.php"; ?>