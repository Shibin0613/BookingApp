<?php
include 'PhotoClass.php';
require_once "../vendor/autoload.php";

use Controllers\DB;

DB::connect();

class Accommodation
{
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
        $accommodation = [

        ];
    }

    public function deleteAccommodation()
    {
        
    }

    public function readAccommodation()
    {
        $accommodationSelect = [

        ];
        $accommodations = DB::select('accommodation', $accommodationSelect, 'Accommodation');
        $accommodationsLength = count($accommodations);

        for ($i = 0; $i < $accommodationsLength; $i++) {
            $accommodations[$i]->images = DB::select('photo', ['accommodationId' => $accommodations[$i]->id], 'Photo');
        }
        return $accommodations;
    }

    public function updateAccommodation()
    {
    }

    public function readAccommodationPlanning()
    {
        $class = "Accommodation";
        $table = "accommodation";
        $data = [];
        $accommodation = DB::select($table, $data, $class);

        $resultLength = count($accommodation);

        for ($i = 0; $i < $resultLength; $i++) {
            $category = DB::select('accommodation', ['id' => $accommodation[$i]->category], 'Accomodation');

            echo "
        {
            id: " . $accommodation[$i]->id . ",
            title: '" . $accommodation[0]->name . "',
            building: " . $category[0]->category . "'
          
        }, ";
        }
    }

}
