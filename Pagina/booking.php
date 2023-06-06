<?php include "header.php";
include "../Functions/services.php";
include "../Classes/AccommodationClass.php";
require_once "../Classes/GuestClass.php";

$service = new Services();
$AccommodationClass = new Accommodation();
if (isset($_GET['id'])) {
$accommodationId = $_GET['id'];
}else{
  header("location:accommodatieoverzicht.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../Styles/css.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <title>booking</title>
</head>

<body>
  <form method="POST" action="">
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



        <!DOCTYPE html>
        <html>

        <body>
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

        </body>

        </html>




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
    <button name="checkadres">Check adres</button>
    <?php
    $inputValues = $service->addressAPI();
    ?>
  </form>
  <form method="POST" action="../Handlers/bookingHandler.php">

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

</body>

</html>