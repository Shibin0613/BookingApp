<?php
include "header.php";
use Controllers\DB;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Planbord</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Boekingen</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Startdatum</th>
                    <th>Einddatum</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Boekingen uit de database ophalen
    $table = "users"; //Welke table je insert
    $data = [];
    $result1 = DB::select($table, $data);
    $sql = "SELECT naam, startdatum, einddatum FROM boekingen";
    $stmt = $conn->query($sql);
    
    if ($stmt->rowCount() > 0) {
        // Boekingen weergeven
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["naam"] . "</td>";
            echo "<td>" . $row["startdatum"] . "</td>";
            echo "<td>" . $row["einddatum"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Geen boekingen gevonden</td></tr>";
    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>