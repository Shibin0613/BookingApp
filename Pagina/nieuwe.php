<!DOCTYPE html>
<html>
<head>
    <title>Accommodatieoverzicht</title>
    <link rel="stylesheet" href="../Styles/css.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="filter-box">
                <h3>Filter</h3>
                <form action="" method="get">
                    <label for="name">Naam:</label>
                    <input type="text" name="name" id="name">
                    <label for="price">Prijs:</label>
                    <input type="number" name="price" id="price">
                    <label for="categorie">categorie:</label>
                    <input type="text" name="categorie" id="categorie">
                    <label for="price">gas:</label>
                    <input type="text" name="gas" id="gas">
                    <label for="price">water:</label>
                    <input type="text" name="water" id="water">
                    <label for="price">elektriciteit:</label>
                    <input type="text" name="elek" id="elek">
                    <label for="price">personen:</label>
                    <input type="number" name="personen" id="personen">
                    <input type="submit" value="Filteren">
                </form>
            </div>
        </div>
        <div class="accommodations">
            <?php
                // Verbinding maken met de database en query voorbereiden
                $host = "localhost";
                $username = "root";
                $password = "";
                $dbname = "booking";

                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

                try {
                    $pdo = new PDO($dsn, $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Fout bij verbinding met de database: " . $e->getMessage());
                }

                $query = "SELECT * FROM accommodation";

                // Filter toepassen als er zoekparameters zijn
                if (isset($_GET['name']) && !empty($_GET['name'])) {
                    $name = $_GET['name'];
                    $query .= " WHERE name LIKE '%$name%'";
                }

                if (isset($_GET['price']) && !empty($_GET['price'])) {
                    $price = $_GET['price'];
                    if (strpos($query, 'WHERE') !== false) {
                        $query .= " AND price <= $price";
                    } else {
                        $query .= " WHERE price <= $price";
                    }
                }

                if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
                    $name = $_GET['categorie'];
                    $query .= " WHERE categorie LIKE '%$categorie%'";
                }

                $stmt = $pdo->query($query);

                // Accommodaties weergeven
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // $image = $row['image'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $description = $row['description'];

                    echo '<div class="accommodation">';
                    // echo '<div class="image"><img src="'.$image.'"></div>';
                    echo '<div class="info">';
                    echo '<h2>'.$name.'</h2>';
                    echo '<p>Prijs: '.$price.'</p>';
                    echo '<p>'.$description.'</p>';
                    echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</body>
</html>
