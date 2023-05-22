<?php
require_once "../vendor/autoload.php";
include 'PhotoClass.php'; 

use Controllers\DB;

DB::connect();

class Accommodation {
    public int $id;
    public int $category;
    public string $name;
    public int $minimunPeople;
    public int $maximunPeople;
    public bool $gas;
    public bool $electricity;
    public bool $water;
    public int $priceAdults;
    public int $priceKids;
    public int $priceBaby;
    public string $description;
    public string $createDate;
    public array $images;

    public function addAccommodation()
    {

    }

    public function deleteAccommodation()
    {

    }

    public function readAccommodation()
    {
$accommodationSelect = [];
$accommodations = DB::select('accommodation', $accommodationSelect, 'Accommodation');

for ($i=0; $i < count($accommodations); $i++) { 
    $accommodations[$i]->images = DB::select('photo', ['accommodationId' => $accommodations[$i]->id], 'Photo');
    echo "<pre>",print_r($accommodations),"</pre>";
}   
// echo "<pre>",print_r($accommodations),"</pre>";
    }

    public function updateAccommodation()
    {

    }

    public function readAccommodationAgenda()
    {
        $class = "Accommodation";
        $table = "accommodation";
        $data = [];
        $result1 = DB::select($table, $data, $class);
    }
}