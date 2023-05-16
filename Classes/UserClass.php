<?php
use Controllers\DB;

class Users
{
    public int $id;
    public string $email;
    public string $name;


    public function insertUser()
    {
        $naam = $_POST['naam'];
        $achternaam = $_POST['achternaam'];
        $email = $_POST['email'];
        

        $guesttable = "guests";
        $guestdata = [
            'name' => $naam,
            'email' => $email,
        ];
        $insertuser = DB::insert($guesttable, $guestdata);
        return $insertuser;
    }
}