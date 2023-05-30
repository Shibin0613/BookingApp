<?php
include 'PhotoClass.php';
require_once "../vendor/autoload.php";

use Controllers\DB;

DB::connect();

class Accommodation
{
    public int $id;
    public $category;
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

    public function addAccommodation()
    {
        if (isset($_POST['gas'])) {
            $gas = 1;
        } else {
            $gas = 0;
        };
        if (isset($_POST['elek'])) {
            $elek = 1;
        } else {
            $elek = 0;
        };
        if (isset($_POST['water'])) {
            $water = 1;
        } else {
            $water = 0;
        };

        $accommodation = [
            'category' => $_POST['categorie'],
            'name' => $_POST['naam'],
            'minimumPeople' => $_POST['min'],
            'maximumPeople' => $_POST['max'],
            'gas' => $gas,
            'electricity' => $elek,
            'water' => $water,
            'priceAdults' => $_POST['18+'],
            'priceKids' => $_POST['4-18'],
            'priceBaby' => $_POST['0-4'],
            'description' => $_POST['beschrijving'],
            'createDate' => date('Y-m-d'),

        ];

        $addAccommodation = DB::insert('accommodation', $accommodation);

        $image = $_FILES['image']['name'];
        $target = "../Foto/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $accommodation = [];
        $selectAccommodation = DB::select('accommodation', $accommodation, 'Accommodation');
        $lastAccommodationid = end($selectAccommodation)['id'];

        $phototable = "photo";
        $photodata = [
            'photo' => $image,
            'accommodationId' => $lastAccommodationid,
        ];
        $result = DB::insert($phototable,$photodata);
        return $addAccommodation;
    }

    public function deleteAccommodation()
    {
    }

    public function readAccommodation($filterArray, $betweenArray)
    {

        $accommodations = DB::between('accommodation', $filterArray, 'Accommodation', $betweenArray);
        $accommodationsLength = count($accommodations);

        for ($i = 0; $i < $accommodationsLength; $i++) {
            $accommodations[$i]->images = DB::select('photo', ['accommodationId' => $accommodations[$i]->id], 'Photo');
        }
        return $accommodations;
    }

    public function updateAccommodation()
    {
    }

    public function readCategory()
    {
        $categorySelect = [];
        $categories = DB::select('category', $categorySelect, 'Accommodation');

        return $categories;
    }

    public function readAccommodationPlanning()
    {
        $class = "Accommodation";
        $table = "accommodation";
        $data = [];
        $accommodations = DB::select($table, $data, $class);

        $resultLength = count($accommodations);

        for ($i = 0; $i < $resultLength; $i++) {
            // $category = DB::select('category', ['id' => $accommodations[$i]], 'Accommodation');
            echo "
        {
            id: " . $accommodations[$i]->id . ",
            title: '" . $accommodations[$i]->name . "',
        }, ";
        }

        // $class = "Accommodation";
        // $table = "accommodation";
        // $data = [];
        // $accommodation = DB::select($table, $data, $class);

        // $resultLength = count($accommodation);

        // for ($i = 0; $i < $resultLength; $i++) {
        //     $category = DB::select('accommodation', ['id' => $accommodation[$i]->category], 'Accomodation');

        //     echo "
        // {
        //     id: " . $accommodation[$i]->id . ",
        //     title: '" . $accommodation[0]->name . "',
        //     building: " . $category[0]->category . "'

        // }, ";
        //}
    }
}
