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
        // Create email headers
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();

        // Create email subject(onderwerp)
        $subject = "Morgen is het zover";

        // Create email message
        $message = '';
        $message .= "<html><body>";
        $message .= "<br/>";
        $message .= "Beste heer of mevrouw $guestname, " . "<br/>";
        $message .= "Morgen is het zover." . "<br/><br/>";
        $message .= "Geniet er van!" . "<br/><br/>";
        foreach ($weerApiValues as $result) {
            $message .= "dag: ".$result['dag'];
            $message .= "mintemp: ".$result['mintemp'];
            $message .= "maxtemp: ".$result['maxtemp'];
            $message .= "toestand: ".$result['toestand']."<br/>";
        }
        $message .= "Met vriendelijke groet," . "<br/>";
        $message .= "Boeking";
        $message .= "</body></html>";

        mail($guestemail, $subject, $message, $headers);
    }
        
}





?>