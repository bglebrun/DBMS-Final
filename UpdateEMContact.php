<?php include "boilerplates/header.php"; ?><h2>Drop A Class</h2>

    <form method="post" action="UpdateEMContact.php">

    <?php 
        require "config.php";
        $conn = new mysqli($host, $username, $password, $dbname, $port)
            or die ('Could not connect to the database server' . mysqli_connect_error());
    
        if(isset($_POST['submit'])) {
            $IDNo = $_POST['IDNumber'];
            $EMNum = $_POST['EmergencyContact'];


            $sql = "UPDATE Students SET EmergencyContact='$EMNum' WHERE StudentID=$IDNo;";

            $results = $conn->query($sql);
            $message = "Emergceny contact information updated";
        } 
    ?>

    	<label for="IDNumber">Student ID Number</label>
    	<input type="text" name="IDNumber" id="IDNumber">
    	<label for="EmergencyContact">Emergency Contact Number</label>
    	<input type="text" name="EmergencyContact" id="EmergencyContact">
    	<input type="submit" name="submit" value="Submit">  
    </form>

    <?php
    if (isset($_POST['message'])) {
        echo "<br><br>$message";
    }
    ?>

<?php include "boilerplates/footer.php"; ?>