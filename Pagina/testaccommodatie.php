<?php include "../Classes/AccommodationClass.php";
include "header.php";
$AccommodationClass = new Accommodation();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Accommodatieoverzicht</title>
    <link rel="stylesheet" href="../Styles/css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="filter-box">
                <h3>Filter</h3>
                <form action="" method="get">
                    <label for="price">Prijs</label>
                    <input type="number" name="minimumprice" id="minimumprice" placeholder="minimum prijs" min="0">
                    <input type="number" name="maximumprice" id="maximumprice" placeholder="maximum prijs">

                    <label>Datum</label>
                    <input type="date" name="startDate" id="startDate" placeholder="begin datum">
                    <input type="date" name="endDate" id="endDate" placeholder="eind datum">
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

            if (isset($_POST['minimumprice']) && trim($_POST['minimumprice']) !== "") {
                $betweenArray['priceAdults'] = $_GET['minimumprice'];
            } else {
                $betweenArray['priceAdults'] = 0;
            }
            if (isset($_POST['maximumprice']) && trim($_POST['maximumprice']) !== "") {
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
                        <input hidden name="accommodationid" value="<?= $accommodations[$i]->id ?>">
                        <h2><?= $accommodations[$i]->name ?></h2>
                        <p>Prijs: <?= $accommodations[$i]->priceAdults ?></p>
                        <p><?= $accommodations[$i]->description ?></p>
                        <button style="float:right" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?=$accommodations[$i]->id?>">Reserveren</button>
                    </div>
                    </div>
                    <!-- Popup -->
                <div class="modal fade" id="myModal<?=$accommodations[$i]->id?>" role="dialog">
                  <div class="modal-dialog">
                  
                    <!-- Popup content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?=$accommodations[$i]->name ?></h4>
                      </div>
                      <div class="modal-body">
                        <form id="addressForm">
                        <input hidden name="id" value="<?=$accommodations[$i]->id?>">
    <?php if (isset($_SESSION['userId'])) : ?>
      <div class="form-group">



        <label for="categorie">Categorie</label>
        <select name="categorie" id="categoryDropdown" onchange="updateSecondDropdown()">
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
      </div>
      <div class="form-group">
        <label for="accommodatie">Accommodatie</label>
        <select name="accommodatie" id="accommodationDropdown">
          <?php
          $accommodatie = $AccommodationClass->readAccommodation([]);
          foreach ($accommodatie as $result) {
            $categorieid = $result->id;
            $categorienaam = $result->name;
            echo "
            <option value='" . $categorieid . "'>" . $categorienaam . "</option>
            ";
          }
          ?>
        </select>
          <script>
            function updateSecondDropdown() {
              var firstDropdown = document.getElementById("categoryDropdown");
              var secondDropdown = document.getElementById("accommodationDropdown");

              // Clear existing options
              secondDropdown.innerHTML = "";

              // Get the selected option from the first dropdown
              var selectedOption = firstDropdown.value;

              // Make an AJAX request to the PHP script
              $.ajax({
                type: "POST",
                url: "../Handlers/fetchAccommodations.php", // Separate PHP script for fetching data
                data: {
                  variable: selectedOption
                },
                success: function(response) {
                  // Handle the response from the PHP script
                  var accommodations = JSON.parse(response);
                  accommodations.forEach(function(accommodation) {
                    addOption(secondDropdown, accommodation.name, accommodation.id);
                  });
                }
              });

            }

            function addOption(selectElement, optionText, optionId) {
              var option = document.createElement("option");
              option.text = optionText;
              option.value = optionId;
              selectElement.add(option);
            }
          </script>

      </div>
    <?php endif ?>
    <div class="form-group">
      <label for="postcode">Postcode</label>
      <input type="text" class="form-control" id="postcode" name="postcode" required>
    </div>
    <div class="form-group">
      <label for="huisnummer">Huisnummer</label>
      <input type="text" class="form-control" id="huisnummer" name="huisnummer" required>
    </div>
    <input type="button" value="Check adres" onclick="checkAddress()">
  </form>
  <div id="addressContainer"></div>
  <form method="POST" action="../Handlers/bookingHandler.php">
    <input value="<?=$accommodations[$i]->id?>">
    <input hidden name='postcode' value='<?= $inputValues['postcode'] ?>'>
    <input hidden name='huisnummer' value='<?= $inputValues['huisnummer'] ?>'>
    <input hidden name='woonplaats' value='<?= $inputValues['woonplaats'] ?>'>
    <input hidden name="accommodationid" value='<?= $accommodationId?>'>
    <div class="form-group">
      <label for="naam">Naam</label>
      <input type="text" class="form-control" id="naam" name="naam" required>
    </div>
    <input type="hidden" name="datum" type="date" value="<?= date("Y-m-d"); ?>">
    <div class="form-group">
      <label for="achternaam">Achternaam</label>
      <input type="text" class="form-control" id="achternaam" name="achternaam" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="18+">18+ jaar</label>
      <input type="number" class="form-control" id="18+" name="18+" value="1" min="1" max="10">
    </div>
    <div class="form-group">
      <label for="4-18">4-18 jaar</label>
      <input type="number" class="form-control" id="4-18" name="4-18" value="0" min="0" max="10">
    </div>
    <div class="form-group">
      <label for="0-4">0-4 jaar</label>
      <input type="number" class="form-control" id="0-4" name="0-4" value="0" min="0" max="10">
    </div>
    <div class="form-group">
      <label for="date">Checkin datum</label>
      <input type="date" class="form-control" id="date" name="checkindate" value="<?php echo date("Y-m-d", strtotime('+5 days')); ?>">
    </div>
    <div class="form-group">
      <label for="date">Checkout datum</label>
      <input type="date" class="form-control" id="date" name="checkoutdate" value="<?php echo date("Y-m-d", strtotime('+10 days')); ?>">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                    
                  </div>
                </div>
                    <?php endfor ?>
                </div>
            </div>
        </body>
    </html>
    <script>
    function checkAddress() {
        var postcode = $('#postcode').val();
        var huisnummer = $('#huisnummer').val();

        // Make the AJAX request
        $.ajax({
            type: 'POST',
            url: 'testboeking.php', // Replace with the path to your server-side file
            data: {
                checkadres: true,
                postcode: postcode,
                huisnummer: huisnummer
            },
            dataType: 'json',
            success: function (response) {
                if (response.error) {
                    // Display an error message
                    $('#addressContainer').html('<p>' + response.error + '</p>');
                } else {
                    // Update the address information
                    var addressHtml = '<div class="form-group">' +
                        '<label for="adres">check</label>' +
                        '<input type="text" class="form-control" id="adres" name="adres" value="' + response.straat + ' ' + huisnummer + '" readonly>' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="woonplaats">Woonplaats</label>' +
                        '<input type="text" class="form-control" id="woonplaats" name="woonplaats" value="' + response.woonplaats + '" readonly>' +
                        '</div>';

                    $('#addressContainer').html(addressHtml);
                }
            },
            error: function () {
                // Display an error message
                $('#addressContainer').html('<p>An error occurred while retrieving the address.</p>');
            }
        });
    }
</script>