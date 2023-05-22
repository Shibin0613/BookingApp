<?php
include 'PhotoClass.php';
use Controllers\DB;
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
    public DateTime $created;
    public array $images;

    public function addAccommodation()
    {

    }

    public function deleteAccommodation()
    {

    }

    public function readAccommodation()
    {
        
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