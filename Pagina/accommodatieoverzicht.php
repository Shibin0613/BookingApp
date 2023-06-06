<?php include "../Classes/AccommodationClass.php";
include "header.php";

$AccommodationClass = new Accommodation();
$AccommodationClass->test();
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
                    <label for="price">Prijs</label>
                    <input type="number" name="minimumprice" id="minimumprice" placeholder="minimum prijs">
                    <input type="number" name="maximumprice" id="maximumprice" placeholder="maximum prijs">

                    <label>Datum</label>
                    <input type="date" name="startDate" id="startDate" placeholder="begin datum">
                    <input type="date" name="endDate" id="endDate" placeholder="eind datum">
                    <label for="categorie">Categorie</label>
                    <select name="categorie">
                        <?php
                        $category = $Accommodations->readCategory();
                        foreach ($category as $result) {
                            $categorieid = $result->id;
                            $categorienaam = $result->category;
                            echo "
                            <option value='" . $categorieid . "'>" . $categorienaam . "</option>
                            ";
                        }
                        ?>
                    </select>
                    <label class="switch">Gas
                        <input type="checkbox" id="gas" name="gas">
                        <span class="slider round"></span>
                    </label>
                    <label class="switch">Water
                        <input type="checkbox" id="water" name="water">
                        <span class="slider round"></span>
                    </label>
                    <label class="switch">elektriciteit
                        <input type="checkbox" id="electricity" name="electricity">
                        <span class="slider round"></span>
                    </label>
                    <!-- <label for="price">personen</label>
                    <input type="number" name="minPeople" id="minPeople" placeholder="minimum personen">
                    <input type="number" name="maxPeople" id="maxPeople" placeholder="maximum personen"> -->
                    <input type="submit" value="Filter">
                </form>
            </div>
        </div>
        <div class="accommodations">
            <?php

            $filterArray = [];
            $betweenArray = [];

            if (isset($_GET['minimumprice']) && trim($_POST['minimumprice']) !== "") {
                $betweenArray['priceAdults'] = $_GET['minimumprice'];
            } else {
                $betweenArray['priceAdults'] = 0;
            }
            if (isset($_GET['maximumprice']) && trim($_POST['maximumprice']) !== "") {
                $betweenArray['priceAdultMaximum'] = $_GET['maximumprice'];
            } else {
                $betweenArray['priceAdultMaximum'] = 10000;
            }
            if (isset($_GET['category']) && trim($_POST['category']) !== "") {
                $filterArray['category'] = $_GET['category'];
            }
            if (isset($_GET['gas'])) {
                $filterArray['gas'] = 1;
            } else {
                $filterArray['gas'] = 0;
            }
            if (isset($_GET['water'])) {
                $filterArray['water'] = 1;
            } else {
                $filterArray['water'] = 0;
            }
            if (isset($_GET['electricity'])) {
                $filterArray['electricity'] = 1;
            } else {
                $filterArray['electricity'] = 0;
            }
            // if (isset($_GET['minPeople']) == !empty($_GET['minPeople'])) {
            //     $betweenArray['minimumPeople'] = $_GET['minPeople'];
            // }
            // if (isset($_GET['maxPeople']) == !empty($_GET['maxPeople'])) {
            //     $filterArray['maximumPeople'] = $_GET['maxPeople'];
            // }

            $accommodations = $AccommodationClass->readAccommodation($filterArray, $betweenArray);
            $accommodationsLength = count($accommodations);
            for ($i = 0; $i < $accommodationsLength; $i++) :


                $image = $accommodations[$i]->images[0];
            ?>
                <div class="accommodation">
                    <div class="image"><img src="<?= $image->photo ?>"></div>
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