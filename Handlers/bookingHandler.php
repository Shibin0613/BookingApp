<?php
include_once("../Classes/GuestClass.php");
include"../pagina/header.php";
use Controllers\DB;

$guestService = new Guests();

if(empty($_POST['naam'] && $_POST['email'])){
    header('location: ../pagina/booking.php');
}else{
    $createdGuest = $guestService->createGuest();
  
    if($createdGuest) :
      echo "<script>alert('Boeking is aangemaakt')</script>"; ?>
      <META HTTP-EQUIV="Refresh" CONTENT="0; URL=../pagina/accommodatieoverzicht.php">
    <?php else :
      echo "<script>alert('Het is niet gelukt om een boeking aan te maken, probeer later opnieuw!')</script>"; ?>
      <META HTTP-EQUIV="Refresh" CONTENT="0; URL=../pagina/booking.php">
      <?php
    header('location: ../pagina/accommodatieoverzicht.php');
    endif;
}

?>
