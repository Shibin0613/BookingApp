<?php include "header.php";
include "../Functions/services.php";

$service = new Services();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../Styles/css.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>booking</title>
</head>

<body>
  <form method="POST" action="">
    <?php if (isset($_SESSION['id'])) : ?>
      <div class="form-group">
        <label for="categorie">Categorie</label>
      </div>
      <div class="form-group">
        <label for="accommodatie">Accommodatie</label>
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
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
      <label for="date">Vertrekdatum</label>
      <input type="date" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d", strtotime('+5 days')); ?>">
    </div>
    <div class="form-group">
      <label for="aantal">Aantal nachten</label>
      <input type="number" class="form-control" id="aantal" name="aantal" value="1" min="1" max="14">
    </div>
  </form>

</body>

</html>