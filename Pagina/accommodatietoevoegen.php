<?php 
require_once "../vendor/autoload.php";
use Controllers\DB;

DB::connect();
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
<form method="POST" action="../Handlers/accommodationHandler.php">
  <div class="form-group">
    <label for="naam">Naam</label>
    <input type="text" class="form-control" id="naam" name="naam" required>
  </div>
  <div class="form-group">
    <label for="beschrijving">Beschrijving</label>
    <input type="text" class="form-control" id="beschrijving" name="beschrijving" required>
  </div>
  <div class="form-group">
    <label for="prijs">Prijs</label>
    <input type="text" class="form-control" id="prijs" name="prijs" required>
  </div>
  <div class="form-group">
    <label for="categorie">Categorie</label>
    <?php 
    $class = "Class";
    $categorytable = "category";
    $categorydata = [];
    $category = DB::select($categorytable,$categorydata,$class);
    var_dump($category);
    ?>
  </div>
  <div class="form-group">
    <label for="foto">Foto</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="18+">water</label>
    <input type="checkbox" class="form-control" id="18+" name="18+" value="1" min="1" max="10">
  </div>
  <div class="form-group">
    <label for="4-18">elektriciteit</label>
    <input type="checkbox" class="form-control" id="4-18" name="4-18" value="0" min="0" max="10">
  </div>
  <div class="form-group">
    <label for="0-4">gas</label>
    <input type="checkbox" class="form-control" id="0-4" name="0-4" value="0" min="0" max="10">
  </div>
  <div class="form-group">
    <label for="date">Min</label>
    <input type="number" class="form-control" id="date" name="date" value="1" min="1" max="14">
  </div>
  <div class="form-group">
    <label for="aantal">Max</label>
    <input type="number" class="form-control" id="aantal" name="aantal" value="4" min="4" max="14">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>

</body>
</html>

