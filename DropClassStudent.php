<?php include "boilerplates/header.php"; ?><h2>Drop A Class</h2>

    <form method="post" action="DropClassStudent.php">

    <?php 
        require "config.php";
        $conn = new mysqli($host, $username, $password, $dbname, $port)
            or die ('Could not connect to the database server' . mysqli_connect_error());
    
        if(isset($_POST['submit'])) {
            $IDNo = $_POST['IDNo'];
            $CID = $_POST['CID'];


            $sql = "DELETE FROM StudentCourses WHERE StudentID = $IDNo and CourseID = $CID;";

            $results = $conn->query($sql);
            $message = "Course dropped from schedule";
        } 
    ?>

    	<label for="IDNumber">Student ID Number</label>
    	<input type="text" name="IDNo" id="IDNo">
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