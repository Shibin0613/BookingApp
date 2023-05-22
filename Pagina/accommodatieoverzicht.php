<?php include "../Classes/AccommodationClass.php";

$AccommodationClass = new Accommodation();

?>

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
                    <input type="text" name="elektriciteit" id="elektriciteit">
                    <label for="price">min personen:</label>
                    <input type="number" name="minpersonen" id="minpersonen">
                    <label for="price">max personen:</label>
                    <input type="number" name="maxpersonen" id="maxpersonen">
                    <input type="submit" value="Filteren">
                </form>
            </div>
        </div>
        <div class="accommodations">
            <?php

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

            $accommodations = $AccommodationClass->readAccommodation();
            $accommodationsLength = count($accommodations);
            for ($i = 0; $i < $accommodationsLength; $i++) :


                $image = $accommodations[$i]->images[0];
            ?>
                <div class="accommodation">
                    <div class="image"><img src="'.$image.'"></div>
                    <div class="info">
                        <h2><?= $accommodations[$i]->name ?></h2>
                        <p>Prijs: <?= $accommodations[$i]->priceAdults ?></p>
                        <p><?= $accommodations[$i]->description ?></p>
                    </div>
                </div>
            <?php endfor ?>
        </div>
    </div>
</body>

</html>