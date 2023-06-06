<?php
include_once("../Classes/AccommodationClass.php");
include_once("../Classes/BookingClass.php");
include "../pagina/header.php";

use Controllers\DB;

$accommodationService = new Accommodation();
$bookingService = new Booking();

if (isset($_POST['submit'])) {
    $createdAccommodation = $accommodationService->addAccommodation($_FILES);

    if ($createdAccommodation) :
        echo "<script>alert('Accommodatie is toegevoegd')</script>"; ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=../pagina/accommodatietoevoegen.php">
    <?php else :
        echo "<script>alert('Het is niet gelukt om een accommodatie toe te voegen, probeer later opnieuw!')</script>"; ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=../pagina/accommodatietoevoegen.php">
    <?php
    endif;
}

if (isset($_POST['verwijderen'])) {
    $deletedBooking = $bookingService->deleteBooking();
    $deletedAccommodation = $accommodationService->deleteAccommodation();

    if ($deletedAccommodation == false) :
        echo "<script>alert('Accommodatie is verwijderd')</script>"; ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=../pagina/accommodatiewijzigen.php">
    <?php else :
        echo "<script>alert('Het is niet gelukt om een accommodatie te verwijderen, probeer later opnieuw!')</script>"; ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=../pagina/accommodatiewijzigen.php">
    <?php
    endif;
}

if (isset($_POST['wijzigen'])) {
    $updatedAccommodation = $accommodationService->updateAccommodation();

    if ($updatedAccommodation) :
        echo "<script>alert('Accommodatiegegevens is opgeslagen')</script>"; ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=../pagina/accommodatiewijzigen.php">
    <?php else :
        echo "<script>alert('Het is niet gelukt om een accommodatiegegevens op te slaan, probeer later opnieuw!')</script>"; ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=../pagina/accommodatiewijzigen.php">
<?php
    endif;
}
