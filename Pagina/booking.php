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
      </div>
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
      <input type="number" class="form-control" id="inputNumber1" name="number1" value="1" min="1" max="10">
    </div>
    <div class="form-group">
      <label for="4-18">4-18 jaar</label>
      <input type="number" class="form-control" id="inputNumber2" name="number2" value="0" min="0" max="10">
    </div>
    <div class="form-group">
      <label for="0-4">0-4 jaar</label>
      <input type="number" class="form-control" id="inputNumber3" name="number3" value="0" min="0" max="10">
    </div>
    Totale bedrag: €<div id ="result"></div><br>
    <div class="form-group">
      <label for="date">Checkin datum</label>
      <input type="date" class="form-control" id="date" name="checkindate" value="<?php echo date("Y-m-d", strtotime('+5 days')); ?>">
    </div>
    <div class="form-group">
      <label for="date">Checkout datum</label>
      <input type="date" class="form-control" id="date" name="checkoutdate" value="<?php echo date("Y-m-d", strtotime('+10 days')); ?>">
    </div>
    
    <input id="resultInput">
    <script>
      var resultInput = '<input type="hidden" id="resultInput" name="result" value="' + response + '">';
    </script>
    <?php
    use Controllers\DB;
    $accommodationtable = "accommodation";
    $accommodationdata = [
      'id' => $accommodationId,
    ];
    $accommodation=DB::select($accommodationtable,$accommodationdata,"Accommodation");
    ?>

    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    var priceAdults = <?php echo $accommodation[0]->priceAdults; ?>;
    var priceKids = <?php echo $accommodation[0]->priceKids; ?>;
    var priceBaby = <?php echo $accommodation[0]->priceBaby; ?>;
    $('input[type="number"]').on('input', function() {
      var inputNumber1 = $('#inputNumber1').val();
      var inputNumber2 = $('#inputNumber2').val();
      var inputNumber3 = $('#inputNumber3').val();

      $.ajax({
        url: 'prijs.php',
        type: 'POST',
        data: {
          number1: inputNumber1,
          number2: inputNumber2,
          number3: inputNumber3,
          priceAdults: priceAdults,
          priceKids: priceKids,
          priceBaby: priceBaby },
          success: function(response) {
            var resultDiv = '<div id="result">' + response + '</div>';
            var resultInput = '<input hidden id="resultInput" name="result" value="' + response + '">';
            $('#result').replaceWith(resultDiv);
            $('#resultInput').replaceWith(resultInput);
          }
      });
    });
  });
  
</script>

</body>

</html>