<?php
$clientId = 'YOUR_CLIENT_ID'; // Replace with your actual client ID
$clientSecret = 'YOUR_CLIENT_SECRET'; // Replace with your actual client secret

// Create a request URL
$requestUrl = 'https://data.meteoserver.nl/api/dagverwachting.php?locatie=Sneek&key=5763837a25';

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
if (!empty($data['data'])) {
    foreach($data['data'] as $result)
    {
        echo $result['dag']."<br>";
        echo "mimimum temperatuur: ".$result['min_temp']."<br>";
        echo "maximum temperatuur: ".$result['max_temp']."<br>";
        echo "Weer: ".$result['toestand']."<br>";
        echo "<br>";

    }
}