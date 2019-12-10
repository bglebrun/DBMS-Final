<?php include 'boilerplates/header.php'?>
<h2>View Schedule</h2>

<form method="post" action="displaySchedule.php">

    <?php
        require "config.php";
        $conn = new mysqli($host, $username, $password, $dbname, $port)
        or die ('Could not connect to the database server' . mysqli_connect_error());

        if(isset($_POST['submit'])) {
            $IDNo = $_POST['IDNumber'];

            $sql = "SELECT r.StudentID, r.CourseID AS 'Section', c.Title, c.CourseNumber, i.Prefix, c.ClassRoom, p.FName AS 'Prof. first name', p.LName AS 'Prof. last name' from StudentCourses r 
            JOIN Courses c
            ON c.CourseID = r.CourseID
            JOIN Students s 
            ON r.StudentID = s.StudentID
            JOIN Prefixes i
            ON i.PrefixID = c.Prefix
            JOIN Professors p
            ON p.ProfessorID = c.Instructor
            
            where r.StudentID = $IDNo";

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
    <label for="IDNumber">Student ID</label>
    <input type="text" name="IDNumber" id="IDNumber">
    <input type="submit" name="submit" value="Submit">

</form>
<?php include 'boilerplates/footer.php'?>
