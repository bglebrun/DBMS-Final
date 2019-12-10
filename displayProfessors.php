<?php require "boilerplates/header.php"; ?>
<h2>University List</h2>

<?php
    require "config.php";
    $conn = new mysqli($host, $username, $password, $dbname, $port)
        or die ('Could not connect to the database server' . mysqli_connect_error());

    $results = $conn->query("SELECT p.ProfessorID, p.FName AS 'First Name' , p.LName AS 'Last Name', d.Title , p.Phone, p.email
    FROM Professors p
    JOIN Departments d ON d.DepartmentID = p.Department");
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