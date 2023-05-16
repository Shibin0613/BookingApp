<?php
include 'UserClass.php';
use Controllers\DB;

class Guests extends Users
{
    public string $postalCode;
    public string $houseNumber;

    public function createGuest() 
    {
        $postalCode = $_POST['postcode'];
        $houseNumber = $_POST['huisnummer'];

        $guesttable = "guests";
        $guestdata = [
            'postalcode' -> $postalCode,
            'housenumber' -> $houseNumber,
        ];

        $createguest = DB::insert($guesttable, $guestdata,'Guests');
        return $createguest;
    }

    public function readGuest($id)
    {
        
    } 
}