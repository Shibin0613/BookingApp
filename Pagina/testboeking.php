<?php
if (isset($_POST['checkadres'])) {
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

        // Prepare the address array
        $array = [
            'postcode' => $postcode,
            'huisnummer' => $huisnummer,
            'woonplaats' => $woonplaats
        ];

        // Send the address array as JSON response
        echo json_encode($array);
    } else {
        // Handle the case when no address is found
        echo json_encode(['error' => 'De postcode bestaat niet']);
    }
}
?>
