<?php 
require_once "../vendor/autoload.php";

use Controllers\DB;

session_start();
DB::connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Styles/css.css">
</head>
<body>
    <?php 
    if (isset($_SESSION['userId'])) : ?>
    <header class="header">
  <div class="header-container">
    <nav class="nav">
      <ul class="nav-list">
        <li class="nav-item"><a href="accommodatietoevoegen.php">Accommodatie toevoegen</a></li>
        <li class="nav-item"><a href="accommodatieoverzicht.php">Accommodaties</a></li>
        <li class="nav-item"><a href="booking.php">Boeken</a></li>
        <li class="nav-item"><a href="planbord.php">Planbord</a></li>
        <li class="nav-item"><form action="" method="POST"><button name="uitlog">Uitloggen</button></form></li>
      </ul>
</header>
    <?php endif; 
    if(isset($_POST['uitlog']))
    {
      session_start();
      session_destroy();
      header("location:login.php");
      exit();
    }
    
    ?>