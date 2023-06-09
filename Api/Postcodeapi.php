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
  $postcode = $_POST['postcode'];
  $huisnummer = $_POST['huisnummer'];
  // Set up your Kadaster API credentials
$clientId = 'YOUR_CLIENT_ID'; // Replace with your actual client ID
$clientSecret = 'YOUR_CLIENT_SECRET'; // Replace with your actual client secret

// Create a request URL
$requestUrl = 'https://geodata.nationaalgeoregister.nl/locatieserver/v3/free?q=' . urlencode($postcode) . '&fq=type:adres&rows=1';

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
if (!empty($data['response']['docs'])) {
    // Retrieve the first address
    $address = $data['response']['docs'][0];

    // Extract relevant address components
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