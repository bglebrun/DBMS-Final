<?php include 'boilerplates/header.php'?>
<h2>Find Student</h2>

<form method="post" action="findStudent.php">

    <?php
        require "config.php";
        $conn = new mysqli($host, $username, $password, $dbname, $port)
        or die ('Could not connect to the database server' . mysqli_connect_error());

        if(isset($_POST['submit'])) {
            $FName = $_POST['FName'];
            $LName = $_POST['LName'];
            $IDNo = $_POST['IDNo'];
            $sql = "";

            if(empty($IDNo)) {

                $sql = "SELECT *
                FROM Students
    
                where FName = '$FName' or LName = '$LName'";    
            } else {
                $sql = "SELECT *
                FROM Students
    
                where FName = '$FName' or LName = '$LName' or StudentID = $IDNo";
            }

            $results = $conn->query($sql);

            
            echo "<table>";
            echo "<tr>";

            while($field=$results->fetch_field()) {
                echo "<th>";
                echo "$field->name";
                echo "</th>";
            }
            echo "</tr>";

            if ($results) {
                while($row=$results->fetch_row()) {
                    echo "<tr>";
                    for($i=0; $i < $results->field_count;$i++) {
                        echo "<td> $row[$i] </td>";
                    }
                    echo "</tr>\n";
                }
            }
            echo "</table>";
            $results->close();
            $conn->close();
        }
    ?>
    <label for="FName">Student First Name</label>
    <input type="text" name="FName" id="FName">
    <label for="LName">Student Last Name</label>
    <input type="text" name="LName" id="LName">
    <label for="IDNo">Student ID Number</label>
    <input type="text" name="IDNo" id="IDNo">
    <input type="submit" name="submit" value="Submit">

</form>
<?php include 'boilerplates/footer.php'?>
