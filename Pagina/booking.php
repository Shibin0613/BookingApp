<?php
include_once("../Classes/BookingClass.php");
include_once("../Classes/GuestClass.php");
include_once("../Classes/UserClass.php");


use Controllers\DB;

$guestService = new Guests();
$userService = new Users();
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
  <div class="form-group">
    <label for="postcode">Postcode</label>
    <input type="text" class="form-control" id="postcode" name="postcode" required>
  </div>
  <div class="form-group">
    <label for="huisnummer">Huisnummer</label>
    <input type="text" class="form-control" id="huisnummer" name="huisnummer" required>
  </div>
  <button name ="checkadres">Check adres</button>
  <?php
if(isset($_POST['checkadres'])){
$postalCode = $_POST['postcode']; // Replace with the postal code you want to search
$huisnummer = $_POST['huisnummer'];

// Set up your Kadaster API credentials
$clientId = 'YOUR_CLIENT_ID'; // Replace with your actual client ID
$clientSecret = 'YOUR_CLIENT_SECRET'; // Replace with your actual client secret

// Create a request URL
$requestUrl = 'https://geodata.nationaalgeoregister.nl/locatieserver/v3/free?q=' . urlencode($postalCode) . '&fq=type:adres&rows=1';

// Set up the cURL request
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $requestUrl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret)
));

// Send the request
$response = curl_exec($curl);

// Parse the JSON response
$data = json_decode($response, true);

// Check if the response contains any addresses
if (isset($data['response']['numFound']) && $data['response']['numFound'] > 0) {
    // Retrieve the first address
    $address = $data['response']['docs'][0];

    // Extract relevant address components
    $postcode = $address['postcode'];
    $straat = $address['straatnaam'];
    $woonplaats = $address['woonplaatsnaam'];

    // Output the address
    echo"
    <div class='form-group'>
    <label for='adres'>Adres</label>
    <input type='text' class='form-control' id='adres' name='adres' value='".$straat." ".$huisnummer."' readonly>
    </div>
    <div class='form-group'>
    <label for='woonplaats'>Woonplaats</label>
    <input type='text' class='form-control' id='woonplaats' name='woonplaats' value='".$woonplaats."' readonly>
    </div>
    ";
}else{
    echo "<script>alert('De postcode bestaat niet')</script>";
}
}
?>
</form>
<form method="POST" action="">
  <div class="form-group">
    <label for="naam">Naam</label>
    <input type="text" class="form-control" id="naam" name="naam" required>
  </div>
  <input hidden name='postcode' value='<?php echo $postcode;?>'>
  <input hidden name='huisnummer' value='<?php echo $huisnummer;?>'>
  <div class="form-group">
    <label for="achternaam">Achternaam</label>
    <input type="text" class="form-control" id="achternaam" name="achternaam" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
<form method="POST" action="">
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
    <input type="date" class="form-control" id="date" name="date">
  </div>
  <div class="form-group">
    <label for="aantal">Aantal nachten</label>
    <input type="number" class="form-control" id="aantal" name="aantal">
  </div>
</form>

</body>
</html>

<?php
if(isset($_POST['submit'])){
  $createdGuest = $guestService->createGuest();
  $insertedUser = $userService->insertUser();

  if($insertedUser) :
    echo "<script>alert('Boeking is aangemaakt')</script>"; ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=booking.php">
  <?php else :
    echo "<script>alert('Het is niet gelukt om een boeking aan te maken, probeer later opnieuw!')</script>"; ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=booking.php">
<?php endif;
}


?>