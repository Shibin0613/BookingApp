<?php
include_once("../Classes/AccommodationClass.php");
include"../pagina/header.php";
use Controllers\DB;

$accommodationService = new Accommodation();

$createdAccommodation = $accommodationService->addAccommodation();
            
if($createdAccommodation) :
echo "<script>alert('Accommodatie is toegevoegd')</script>"; ?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=../pagina/accommodatietoevoegen.php">
<?php else :
echo "<script>alert('Het is niet gelukt om een accommodatie toe te voegen, probeer later opnieuw!')</script>"; ?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=../pagina/accommodatietoevoegen.php">
<?php
header('location: ../pagina/accommodatieoverzicht.php');
endif;
?>
