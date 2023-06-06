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

        $accommodationid = $_POST['accommodationid'];
        $accommodatietable = "accommodation";
        $accommodationdata = [
            'id' => $accommodationid,
        ];
        $result = DB::select($accommodatietable,$accommodationdata,'Users');
        $name = $result[0]->name;
        
        $boekingtable = "booking";
        $boekingdata = [];
        $result = DB::select($boekingtable,$boekingdata,'Users');
        $checkindate = end($result)->checkInDate;
        $checkoutdate = end($result)->checkOutDate;
        $price = end($result)->price;
        $betaald = "niet betaald";

        // Create email headers
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();

        // Create email subject(onderwerp)
        $subject = "Je hebt een boeking gemaakt";
        
        // Create email message
        $message = "<html><body>";
        $message .= "<br/>";
        $message .= "Beste heer of mevrouw $achternaam, " . "<br/>";
        $message .= "Je hebt zonet een boeking gedaan, hierbij de factuur" . "<br/><br/>";
        $message .= "<table><tr><th>Naam</th><th>Checkin datum</th><th>Checkout datum</th><th>Bedrag</th><th>Betaald</th></tr>";
        $message .= "<td>$name</td><td>$checkindate</td><td>$checkoutdate</td><td>$price</td><td>$betaald</td></tr></table>" . "<br/><br/>";
        $message .= "Te betalen binenn 7 dagen op rekening NL40ABNA012345678 onder vermelding van factuurnummer" . "<br/><br/>";
        
        $message .= "Met vriendelijke groet," . "<br/>";
        $message .= "Boeking";
        $message .= "</body></html>";

        mail($email, $subject, $message, $headers);
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