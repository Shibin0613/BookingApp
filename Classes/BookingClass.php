<?php
require_once "../vendor/autoload.php";
require_once "GuestClass.php";
use Controllers\DB;

DB::connect();

class Booking
{
    public int $id;
    public int $accommodationId;
    public int $guestId;
    public int $days;
    public string $checkInDate;
    public string $checkOutDate;
    public int $people;
    public float $price;
    public bool $paid;

    public function createBooking()
    {
        $createdate = date("Y-m-d");
        $adult = $_POST['number1'];
        $kids = $_POST['number2'];
        $baby = $_POST['number3'];
        $people = $adult+$baby+$baby;
        $price =$_POST['result'];

        $guesttable = "guests";
        $guestdata = [];
        $result = DB::select($guesttable,$guestdata,'Booking');
        $guestid = end($result)->id;
        $achternaam = end($result)->name;
        $email = end($result)->email;

        $bookingtable = "booking";
        $bookingdata = [
            'accommodationId' => $_POST['accommodationid'],
            'guestId' => $guestid,
            'createDate' => $createdate,
            'checkIndate' => $_POST['checkindate'],
            'checkOutDate' => $_POST['checkoutdate'],
            'people' => $people,
            'price' => $price,
            'paid' => 0,
        ];
        $createbooking = DB::insert($bookingtable, $bookingdata);

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
    }

    public function readBookingPlanning()
    {
        $class = "Booking";
        $table = "booking";
        $data = [];
        $bookings = DB::select($table, $data, $class);

            $resultLength = count($bookings);
           
            foreach ($bookings as $booking) {
                $accommodation = DB::select('accommodation', ['id' => $booking->accommodationId], 'Booking');
                $start = new DateTime($booking->checkInDate);
                $end = new DateTime($booking->checkOutDate);
                $guest = DB::select("guests", ['id' => $booking->guestId], 'Guests');
                echo "
                {
                id: " . $booking->id . ",
                title: '" . $accommodation[0]->name . "',
                resourceId: " . $accommodation[0]->id . ",
                start: '" . $start->format('Y-m-d\TH:i:s') . "',
                end: '" . $end->format('Y-m-d\TH:i:s') . "',
                editable: true,
                name: '" . $guest[0]->name . "',
                email: '" . $guest[0]->email . "',
                residence: '" . $guest[0]->residence . "',
                postalCode: '" . $guest[0]->postalCode ."',
            },";
            }
        }


    public function updateBooking()
    {
    }

    public function deleteBooking()
    {
        $id=$_POST['id'];
        $bookingtable = "booking";
        $querybooking = "DELETE FROM $bookingtable WHERE accommodationId= :id";
        $bookingdata = [
            ":id" => $id,
        ];
        $result = DB::delete($querybooking,$bookingdata);
    }
}
