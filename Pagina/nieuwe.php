<!DOCTYPE html>
<html>

<head>
    <title>Accommodatieoverzicht</title>
    <link rel="stylesheet" href="../Styles/css.css">
</head>

<body>
    <div class="container">
        <h1>Accommodatieoverzicht</h1>
        <?php
        // PDO-verbinding maken
        $host = 'localhost';
        $dbname = 'booking';
        $username = 'root';
        $password = '';


        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Fout bij verbinding met de database: " . $e->getMessage());
        }

        // Query uitvoeren om accommodaties op te halen
        $query = "SELECT * FROM accommodation INNER JOIN photo on accommodation.photo";
        $stmt = $pdo->query($query);

        // Accommodaties weergeven
        while ($row = $stmt->fetch(PDO::FETCH_CLASS)) {
            $image = $row['image'];
            $name = $row['name'];
            $price = $row['price'];
            $description = $row['description'];

            echo '<div class="accommodation">';
            echo '<div class="image"><img src="' . $image . '"></div>';
            echo '<div class="info">';
            echo '<h2>' . $name . '</h2>';
            echo '<p>Prijs: ' . $price . '</p>';
            echo '<p>' . $description . '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>

</html>