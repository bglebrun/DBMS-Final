<?php require "boilerplates/header.php"; ?>
<h2>Student Directory</h2>

<?php
    require "config.php";
    $conn = new mysqli($host, $username, $password, $dbname, $port)
        or die ('Could not connect to the database server' . mysqli_connect_error());

    $results = $conn->query("SELECT c.CourseID, c.Title, c.Description, c.CourseNumber, i.Prefix , c.ClassRoom, p.LName AS 'Prof. Last', p.FName AS 'Prof. First'
    FROM Courses c
    JOIN Prefixes i ON i.PrefixID = c.Prefix
    JOIN Professors p ON c.Instructor = p.ProfessorID");
?>

<table>
    <tr>
    <?php
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
        $results->close();
        $conn->close();
    ?>

</table>

<br>

<?php require "boilerplates/footer.php"; ?>