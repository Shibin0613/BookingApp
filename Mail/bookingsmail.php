<?php

// Create email headers
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();

// Create email subject(onderwerp)
$subject = "Klant heeft een betaling gedaan";

// Create email message
$message = "<html><body>";
$message .= "<br/>";
$message .= ", " . "<br/>";
$message .= "Je hebt zonet een boeking gedaan, hierbij de factuur" . "<br/><br/>";
$message .= "Te betalen binenn 7 dagen op rekening NL40ABNA012345678 onder vermelding van factuurnummer" . "<br/><br/>";

$message .= "Met vriendelijke groet," . "<br/>";
$message .= "Boeking";
$message .= "</body></html>";

mail($email, $subject, $message, $headers);
?>