<?php 

class Services
{

    public function addressAPI() 
    {
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
              $array = [
                'postcode' => $postcode,
                'huisnummer' => $huisnummer,
                'woonplaats' => $woonplaats
              ];
              return $array;
          }else{
              echo "<script>alert('De postcode bestaat niet')</script>";
          }
        }  
          
    }

    public function weatherApi()
    {
        $clientId = 'YOUR_CLIENT_ID'; // Replace with your actual client ID
        $clientSecret = 'YOUR_CLIENT_SECRET'; // Replace with your actual client secret

        // Create a request URL
        $requestUrl = "https://data.meteoserver.nl/api/dagverwachting.php?locatie=Sneek&key=5763837a25";

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
            
            array_pop($data['data']);
            array_shift($data['data']);

            $dataArray = array();

            foreach($data['data'] as $result)
            {
                $data = array(
                      "dag" => $result['dag'],
                      "mintemp" => $result['min_temp'],
                      "maxtemp" => $result['max_temp'],
                      "toestand" => $result['toestand']
                );
                $dataArray[] = $data; 
            }
        }   
        return $dataArray;
    }
}