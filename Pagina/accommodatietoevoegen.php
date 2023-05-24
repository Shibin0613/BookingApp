<?php include "header.php"; 

include "../Classes/AccommodationClass.php";
$Accommodations = new Accommodation();
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
    <input type="text" class="form-control" id="naam" name="naam" >
  </div>
  <div class="form-group">
    <label for="beschrijving">Beschrijving</label>
    <input type="text" class="form-control" id="beschrijving" name="beschrijving" >
  </div>
  <div class="form-group">  
    <label for="18+">*18+ jaar</label>
    €<input type="number" style="width:40%;" class="form-control" id="18+" name="18+" min="20" value="20" max="100">
  </div>
  <div class="form-group">
    <label for="4-18">*4-18 jaar</label>
    €<input type="number" style="width:40%;" class="form-control" id="4-18" name="4-18" value="20" min="20" max="100">
  </div>
  <div class="form-group">
    <label for="0-4">*0-4 jaar</label>
    €<input type="number" style="width:40%;" class="form-control" id="0-4" name="0-4" value="20" min="20" max="100">
  </div>
  <div class="form-group">
    <label for="categorie">Categorie</label>
    <select name="categorie">
    <?php 
    $category = $Accommodations->readCategory();
    foreach ($category as $result){
      $categorieid = $result->id;
      $categorienaam = $result->category;
      echo "
    <option value='".$categorieid."'>".$categorienaam."</option>
    ";
    }
    ?>
    </select>
  </div>
  <div class="form-group">
    <label for="file">
    <i class="far fa-file-image"></i> &nbsp;
    Voeg foto toe
    </label><input class="form-control" type="file" id="file" name="image" accept="image/*">
  </div>
  <div class="form-group">
    <label for="water">water</label>
    <input type="checkbox" class="form-control" id="water" name="water">
  </div>
  <div class="form-group">
    <label for="elec">elektriciteit</label>
    <input type="checkbox" class="form-control" id="elek" name="elek">
  </div>
  <div class="form-group">
    <label for="gas">gas</label>
    <input type="checkbox" class="form-control" id="gas" name="gas">
  </div>
  <div class="form-group">
    <label for="min">Min</label>
    <input type="number" style="width:40%;" class="form-control" id="min" name="min" value="2" min="1" max="6">
  </div>
  <div class="form-group">
    <label for="max">Max</label>
    <input type="number" style="width:40%;" class="form-control" id="max" name="max" value="4" min="4" max="14">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  <div style="float:right">
  *: Per nacht per persoon
  <div>
</form>
</body>
</html>