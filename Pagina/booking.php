<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>booking</title>
</head>

<body>
<form>
  <div class="form-group">
    <label for="naam">Naam</label>
    <input type="text" class="form-control" id="naam" name="naam" required>
  </div>
  <div class="form-group">
    <label for="achternaam">Achternaam</label>
    <input type="text" class="form-control" id="achternaam" name="achternaam" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="postcode">Postcode</label>
    <input type="text" class="form-control" id="postcode" name="postcode" required>
  </div>
  <div class="form-group">
    <label for="huisnummer">Huisnummer</label>
    <input type="text" class="form-control" id="huisnummer" name="huisnummer" required>
  </div>
  <div class="form-group">
    <label for="woonplaats">Woonplaats</label>
    <input type="text" class="form-control" id="woonplaats" name="woonplaats" required>
  </div>
  <div class="form-group">
    <label for="0-4">0-4 jaar</label>
    <input type="number" class="form-control" id="0-4" name="0-4" min="0" max="100">
  </div>
  <div class="form-group">
    <label for="4-18">4-18 jaar</label>
    <input type="number" class="form-control" id="4-18" name="4-18" min="0" max="100">
  </div>
  <div class="form-group">
    <label for="18+">18+ jaar</label>
    <input type="number" class="form-control" id="18+" name="18+" min="0" max="100">
  </div>
  <div class="form-group">
    <label for="date">Datum</label>
    <input type="date" class="form-control" id="date" name="date" required>
  </div>
  <div class="form-group">
    <label for="aantal">Aantal mensen</label>
    <input type="number" class="form-control" id="aantal" name="aantal" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>

</html>