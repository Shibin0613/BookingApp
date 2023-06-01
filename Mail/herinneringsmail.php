<?php 
include "../Classes/BookingClass.php";
include "../Functions/services.php";

$service = new Services();

use Controllers\DB;

$BookingClass = new Booking();
$bookingtable = "booking";
$bookingdata = [];
$result=DB::select($bookingtable,$bookingdata,"Booking");

$weerApiValues = $service->weatherApi();
//voor elke row wordt de checkindatum eruit gehaald
foreach($result as $info)
{
    
    $checkindate = $info->checkInDate;
    $todaydate = date("Y-m-d");
    $adaybefore = date('Y-m-d', strtotime($checkindate . ' -1 day'));
    //voor de booking rol met de guestinfo wordt hierbij gehaald uit de database
    $guesttable = "guests";
    $guestdata = [
        'id' => $info->guestId,
    ];
    $guestresult = DB::select($guesttable,$guestdata,"Booking");
    $guestemail = $guestresult[0]->email;
    $guestname = $guestresult[0]->name;
    //als de datum van vandaag gelijk staat met 1daybefore van een van de checkindatum
    if($todaydate == $adaybefore){
        foreach($weerApiValues as $test)
        {
            echo $test;
        }
        
    }
}



?>