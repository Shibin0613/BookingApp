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
        $adult = $_POST['18+'];
        $kids = $_POST['4-18'];
        $baby = $_POST['0-4'];
        $people = $adult+$baby+$baby;
        $categorie = $_POST['categorie'];
        $accommodation = $_POST['accomodatie'];
        $guesttable = "guests";
        $guestdata = [];
        $result = DB::select($guesttable,$guestdata,'Booking');
        $guestid = end($result)->id;

        $bookingtable = "booking";
        $bookingdata = [
            'accommodationId' => $_POST['accommodationid'],
            'guestId' => $guestid,
            'createDate' => $createdate,
            'checkIndate' => $_POST['checkindate'],
            'checkOutDate' => $_POST['checkoutdate'],
            'people' => $people,
            'price' => 0,
            'paid' => 0,
            'categorie' => $_POST['categorie'],
            'accommodation' => $_POST['accomodatie'],
        ];
        $createbooking = DB::insert($bookingtable, $bookingdata);
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
