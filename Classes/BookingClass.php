<?php
require_once "../vendor/autoload.php";

use Controllers\DB;

DB::connect();

class Booking {
    public int $id;
    public int $accommodationId;
    public int $guestId;
    public int $days;
    public string $createdDate;
    public string $checkInDate;
    public string $checkOutDate;
    public int $people;
    public float $price;
    public bool $paid;

    public function createBooking()
    {
        
    }

    public function readBooking()
    {
        $class = "Booking";
        $table = "booking";
        $data = [];
        $bookings = DB::select($table, $data, $class);
        
            $resultLength = count($bookings);
            for ($i = 0; $i < $resultLength; $i++) {
        $accommodation = DB::select('accommodation', ['id' => $bookings[$i]->accommodationId], 'Booking');
        $start = new DateTime($bookings[$i]->checkInDate);
        $end = new DateTime($bookings[$i]->checkOutDate);
        return "
        {
            id: ".$bookings[$i]->id.",
            title: '".$accommodation[0]->name."',
            resourceId: 'b',
            start: '".$start->format('Y-m-d\TH:i:s')."',
            end: '".$end->format('Y-m-d\TH:i:s')."',
            editable: true,
        }, ";
    }
}
    

    public function updateBooking()
    {

    }

    public function deleteBooking() 
    {

    }
}