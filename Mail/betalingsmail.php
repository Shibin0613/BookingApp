<?php

// Create email headers
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();

// Create email subject(onderwerp)
$subject = "De beheerder heeft jouw betaling goedgekeurd";

// Create email message
$message = "<html><body>";
$message .= "<br/>";
$message .= "Beste heer of mevrouw $achternaam, " . "<br/>";
$message .= "De beheerder heeft jouw betaling goedgekeurd." . "<br/><br/>";
$message .= "We wensen je alvast een goede reis en prettig vakantie!" . "<br/><br/>";

$message .= "Met vriendelijke groet," . "<br/>";
$message .= "Boeking";
$message .= "</body></html>";

mail($email, $subject, $message, $headers);
?>