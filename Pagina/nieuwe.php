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

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query uitvoeren
            $stmt = $pdo->query("SELECT * FROM accommodation");

            // Resultaten weergeven
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="accommodatie">';
                echo '<h2>' . $row['name'] . '</h2>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p>Prijs per nacht: €' . $row['price'] . '</p>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo "Verbindingsfout: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
