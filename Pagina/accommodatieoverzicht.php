<?php include "../Classes/AccommodationClass.php";
include "header.php";

$AccommodationClass = new Accommodation();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Accommodatieoverzicht</title>
    <link rel="stylesheet" href="../Styles/css.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to handle form submission and update accommodations
            function updateAccommodations() {
                var minimumPrice = $('#minimumprice').val();
                var maximumPrice = $('#maximumprice').val();
                var category = $('select[name="categorie"]').val();
                var gas = $('#gas').is(':checked') ? 1 : 0;
                var water = $('#water').is(':checked') ? 1 : 0;
                var electricity = $('#electricity').is(':checked') ? 1 : 0;
                var startDate = $('#startdate').val();
                var endDate = $('#enddate').val();

                $.ajax({
                    type: 'GET',
                    url: '../Handlers/updateAccommodations.php',
                    data: {
                        minimumprice: minimumPrice,
                        maximumprice: maximumPrice,
                        category: category,
                        gas: gas,
                        water: water,
                        electricity: electricity,
                        startdate: startDate,
                        enddate: endDate
                    },
                    success: function(data) {
                        $('.accommodations').html(data);
                    }
                });
            }

            // Bind the form submission event to the updateAccommodations function
            $('form').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission
                updateAccommodations();
            });

            // Initial update when the page loads
            updateAccommodations();
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="filter-box">
                <h3>Filter</h3>
                <form>
                    <label for="price">Prijs</label>
                    <input type="number" name="minimumprice" id="minimumprice" placeholder="minimum prijs" min="0">
                    <input type="number" name="maximumprice" id="maximumprice" placeholder="maximum prijs">
                    <label for="categorie">Categorie</label>
                    <select name="categorie">
                        <?php
                        $category = $AccommodationClass->readCategory();
                        foreach ($category as $result) {
                            $categorieid = $result->id;
                            $categorienaam = $result->category;
                            echo "
                            <option value='" . $categorieid . "'>" . $categorienaam . "</option>
                            ";
                        }
                        ?>
                    </select>
                    <br>
                    <label class="switch">Gas
                        <input type="checkbox" id="gas" name="gas">
                        <span class="slider round"></span>
                    </label>
                    <label class="switch">Water
                        <input type="checkbox" id="water" name="water">
                        <span class="slider round"></span>
                    </label>
                    <label class="switch">Elektriciteit
                        <input type="checkbox" id="electricity" name="electricity">
                        <span class="slider round"></span>
                    </label>
                    <label for="startdate">Start Date</label>
                    <input type="date" name="startdate" id="startdate">

                    <label for="enddate">End Date</label>
                    <input type="date" name="enddate" id="enddate">

                    <input type="submit" value="Filter">
                </form>
            </div>
        </div>
        <div class="accommodations">
            <!-- Accommodation list will be updated here -->
        </div>
    </div>
</body>

</html>
