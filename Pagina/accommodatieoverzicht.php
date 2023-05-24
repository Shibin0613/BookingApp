<?php include "../Classes/AccommodationClass.php";
include "header.php";

$AccommodationClass = new Accommodation();
$accommodationTest = $AccommodationClass->readAccommodation([]); ?>

<pre><?php print_r($accommodationTest); ?> </pre>

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
                    <label for="price">Prijs:</label>
                    <input type="number" name="price" id="price">
                    <label for="categorie">categorie:</label>
                    <input type="text" name="category" id="category">
                    <label for="price">gas:</label>
                    <input type="text" name="gas" id="gas">
                    <label for="price">water:</label>
                    <input type="text" name="water" id="water">
                    <label for="price">elektriciteit:</label>
                    <input type="text" name="electricity" id="electricity">
                    <label for="price">min personen:</label>
                    <input type="number" name="minPeople" id="minPeople">
                    <label for="price">max personen:</label>
                    <input type="number" name="maxPeople" id="maxPeople">
                    <input type="submit" value="Filter">
                </form>
            </div>
        </div>
        <div class="accommodations">
            <?php

            $filterArray = [];
            
            if (isset($_GET['price']) == !empty($_GET['price'])) {
                $filterArray['priceAdults'] = $_GET['price'];
            }if (isset($_GET['category']) == !empty($_GET['category'])) {
                $filterArray['category'] = $_GET['category'];
            }if (isset($_GET['gas']) == !empty($_GET['gas'])) {
                $filterArray['gas'] = $_GET['gas'];
            }if (isset($_GET['water']) == !empty($_GET['water'])) {
                $filterArray['water'] = $_GET['water'];
            }if (isset($_GET['electricity']) == !empty($_GET['electricity'])) {
                $filterArray['electricity'] = $_GET['electricity'];
            }if (isset($_GET['minPeople']) == !empty($_GET['minPeople'])) {
                $filterArray['minimumPeople'] = $_GET['minPeople'];
            }if (isset($_GET['maxPeople']) == !empty($_GET['maxPeople'])) {
                $filterArray['maximumPeople'] = $_GET['maxPeople'];
            }

            $accommodations = $AccommodationClass->readAccommodation($filterArray);
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