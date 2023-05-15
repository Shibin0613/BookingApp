<?php
class Users
{
    public int $id;
    public string $email;
    public string $name;
}

class Admins extends Users
{
    public string $password;

    public function login()
    {
        
    }

    public function logout() 
    {

    }

}

class Guests extends Users
{
    public string $postalCode;
    public string $houseNumber;

    public function createGuest() 
    {

    }

    public function readGuest($id)
    {
        
    } 

}