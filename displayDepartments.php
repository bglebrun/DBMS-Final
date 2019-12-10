<?php require "boilerplates/header.php"; ?>
<h2>Student Directory</h2>

<?php
    require "config.php";
    $conn = new mysqli($host, $username, $password, $dbname, $port)
        or die ('Could not connect to the database server' . mysqli_connect_error());

    $results = $conn->query("SELECT d.DepartmentID, d.Title, i.Prefix, p.FName AS 'Dep. Head First Name',
    p.LName AS 'Dep. Head Last Name', d.Description FROM Departments d
    JOIN Prefixes i ON i.PrefixID = d.Prefix
    JOIN Professors p ON p.ProfessorID = d.DepartmentHead");
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