<?php
include 'PhotoClass.php';

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
}