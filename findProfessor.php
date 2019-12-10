<?php include 'boilerplates/header.php'?>
<h2>Find Professor</h2>

<form method="post" action="findProfessor.php">

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
                $sql = "SELECT p.ProfessorID, p.FName AS 'First Name' , p.LName AS 'Last Name', d.Title , p.Phone, p.email
                FROM Professors p
                JOIN Departments d ON d.DepartmentID = p.Department
    
                where p.FName = '$FName' or p.LName = '$LName'";
            } else {
                $sql = "SELECT p.ProfessorID, p.FName AS 'First Name' , p.LName AS 'Last Name', d.Title , p.Phone, p.email
                FROM Professors p
                JOIN Departments d ON d.DepartmentID = p.Department
    
                where p.FName = '$FName' or p.LName = '$LName' or p.ProfessorID = $IDNo";
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
    <label for="FName">Professor First Name</label>
    <input type="text" name="FName" id="FName">
    <label for="LName">Professor Last Name</label>
    <input type="text" name="LName" id="LName">
    <label for="IDNo">Professor ID Number</label>
    <input type="text" name="IDNo" id="IDNo">
    <input type="submit" name="submit" value="Submit">

</form>
<?php include 'boilerplates/footer.php'?>
