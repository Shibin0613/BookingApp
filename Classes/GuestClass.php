<?php
require_once 'UserClass.php';
use Controllers\DB;

class Guests extends Users
{
    public string $postalCode;
    public string $houseNumber;
    public string $residence;
    public string $createDate;

    public function createGuest() 
    {
        $naam = $_POST['naam'];
        $achternaam = $_POST['achternaam'];
        $email = $_POST['email'];
        $postalCode = $_POST['postcode'];
        $houseNumber = $_POST['huisnummer'];
        $woonplaats = $_POST['woonplaats'];
        $datum = $_POST['datum'];
        
        $guesttable = "guests";
        $guestdata = [
            'name' => $naam,
            'email' => $email,
            'residence' => $woonplaats,
            'postalcode' => $postalCode,
            'housenumber' => $houseNumber,
            'createdate' => $datum,
        ];

        $createguest = DB::insert($guesttable, $guestdata);
        
        return $createguest;
    }


    public function readGuest($id)
    {
        $class = "Guest";
        $table = "guest";
        $data = [];
        $guest = DB::select($table, $data, $class);
    } 
}