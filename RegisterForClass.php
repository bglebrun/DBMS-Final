<?php include "boilerplates/header.php"; ?><h2>Register For Classes</h2>

    <form method="post" action="RegisterForClass.php">

    <?php 
        require "config.php";
        $conn = new mysqli($host, $username, $password, $dbname, $port)
            or die ('Could not connect to the database server' . mysqli_connect_error());
    
        if(isset($_POST['submit'])) {
            $IDNo = $_POST['IDNumber'];
            $CID = $_POST['CID'];


            $sql = "INSERT INTO StudentCourses ( StudentID, CourseID ) VALUES ( $IDNo , $CID );";

            $results = $conn->query($sql);
            $message = "Class added to schedule";
        } 
    ?>

    	<label for="IDNumber">Student ID Number</label>
    	<input type="text" name="IDNumber" id="IDNumber">
    	<label for="Course ID">Course ID</label>
    	<input type="text" name="CID" id="CID">
    	<input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['message'])) {
        echo "<br><br>$message";
    }
    ?>

<?php include "boilerplates/footer.php"; ?>