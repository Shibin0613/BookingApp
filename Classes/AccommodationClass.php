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

    public function addAccommodation($files)
    {

        $min = isset($_POST['min']) ? $_POST['min'] : null;
        $max = isset($_POST['max']) ? $_POST['max'] : null;

        $min = intval($min);
        $max = intval($max);

        if ($min < 1 || $min > 6 || $max < 4 || $max > 14 || $min > $max) {
            die("Zorg dat de min/max personen kloppen.");
        }

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



        DB::insert('accommodation', $accommodation);

        if (!is_dir('../Foto')) {
            mkdir('../Foto', 0777, true);
        }

        $filenamesToSave = [];
        $_FILES = $files;
        $allowedMimeTypes = explode(',', "image/png, image/jpg, image/jpeg");
        if (!empty($_FILES)) {
            if (isset($_FILES['file']['error'])) {
                foreach ($_FILES['file']['error'] as $uploadedFileKey => $uploadedFileError) {
                    if ($uploadedFileError === UPLOAD_ERR_NO_FILE) {
                        $errors[] = 'Er is geen foto meegegeven';
                    } elseif ($uploadedFileError === UPLOAD_ERR_OK) {
                        $uploadedFileName = basename($_FILES['file']['name'][$uploadedFileKey]);

                        if ($_FILES['file']['size'][$uploadedFileKey] <= 50000000000) {
                            $uploadedFileType = $_FILES['file']['type'][$uploadedFileKey];
                            $uploadedFileTempName = $_FILES['file']['tmp_name'][$uploadedFileKey];

                            $uploadedFilePath = rtrim('../Foto', '/') . '/' . $uploadedFileName;

                            if (in_array($uploadedFileType, $allowedMimeTypes)) {
                                if (!move_uploaded_file($uploadedFileTempName, $uploadedFilePath)) {
                                    $errors[] = 'Het bestand "' . $uploadedFileName . '" kon niet worden geupload';
                                } else {
                                    $filenamesToSave[] = $uploadedFilePath;
                                }
                            } else {
                                $errors[] = 'Ongeldig bestandstype "' . $uploadedFileName . '" . Wel geldig: JPG, JPEG, PNG, or GIF.';
                            }
                        } else {
                            $errors[] = 'Het bestand van "' . $uploadedFileName . '" moet maximaal zijn: ' . (5000000000 / 1024) . ' KB';
                        }
                    }
                }
            }
        }

        $accommodation = [];
        $selectAccommodation = DB::select('accommodation', $accommodation, 'Accommodation');
        $lastAccommodationid = end($selectAccommodation)->id;

        foreach ($filenamesToSave as $filename) {
            $phototable = "photo";
            $photodata = [
                'photo' => $filename,
                'accommodationId' => $lastAccommodationid,
            ];
            $result = DB::insert($phototable, $photodata);
        }
        return 1;
    }

    public function deleteAccommodation()
    {
        $id = $_POST['id'];
        $phototable = "photo";
        $queryfoto = "DELETE FROM $phototable WHERE accommodationId= :id";
        $fotodata = [
            ":id" => $id,
        ];
        $result = DB::delete($queryfoto, $fotodata);

        $accommodatietable = "accommodation";
        $queryaccommodatie = "DELETE FROM $accommodatietable WHERE id = :id";
        $accommodatiedata = [
            ":id" => $id,
        ];
        DB::delete($queryaccommodatie, $accommodatiedata);

        return $result;
    }

    public function readAccommodation($filterArray, $betweenArray = [])
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
        $id = $_POST['id'];
        $name = $_POST['naam'];
        $description = $_POST['beschrijving'];
        $minimunPeople = $_POST['min'];
        $maximunPeople = $_POST['max'];
        $priceAdults = $_POST['18+'];
        $priceKids = $_POST['4-18'];
        $priceBaby = $_POST['0-4'];

        $updateAccommodation = DB::update("UPDATE `accommodation` SET `name` = :name, `minimumPeople` = :minimumPeople, `maximumPeople` = :maximumPeople, `priceAdults` = :priceAdults, `priceKids` = :priceKids, `priceBaby` = :priceBaby, `description` = :description WHERE id = :id", [
            'name' => $name,
            'minimumPeople' => $minimunPeople,
            'maximumPeople' => $maximunPeople,
            'priceAdults' => $priceAdults,
            'priceKids' => $priceKids,
            'priceBaby' => $priceBaby,
            'description' => $description,
            'id' => $id
        ]);
        return $updateAccommodation;
    }

    public function readCategory()
    {
        $categories = DB::select('category', [], 'Accommodation');

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

    public function dummyData()
    {
        for ($i = 100; $i < 300; $i++) {
            

            $accommodation = [
                'category' => rand(1, 13),
                'name' => 'huisnummer'.$i,
                'minimumPeople' => rand(1, 5),
                'maximumPeople' => rand(5, 14),
                'gas' => rand(0,1),
                'electricity' => rand(0,1),
                'water' => rand(0,1),
                'priceAdults' => rand(5,40),
                'priceKids' => rand(5,40),
                'priceBaby' => rand(5,40),
                'description' => 'huisnummer '.$i,
                'createDate' => date('Y-m-d'),


            ];



            DB::insert('accommodation', $accommodation);
            $selectAccommodation = DB::select('accommodation', [], 'Accommodation');
            $lastAccommodationid = end($selectAccommodation)->id;

            $phototable = "photo";
            $photodata = [
                'photo' => '../Foto/huisje.png',
                'accommodationId' => $lastAccommodationid,
            ];
            DB::insert($phototable, $photodata);
        }
    }
}
