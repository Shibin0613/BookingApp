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
  
</head>

<body>
  <?php
  if (isset($_SESSION['userId'])) : ?>
    <header class="header">
      <div class="header-container">
        <nav class="nav">
          <ul class="nav-list">
          <li class="nav-item"><a href="planbord.php">Planbord</a></li>
            <li class="nav-item"><a href="accommodatietoevoegen.php">Accommodatie toevoegen</a></li>
            <li class="nav-item"><a href="accommodatiewijzigen.php">Accommodaties</a></li>
            <li class="nav-item"><a href="booking.php">Boeken</a></li>
            <li class="nav-item">
              <form action="" method="POST"><button name="uitlog">Uitloggen</button></form>
            </li>
            <li><?php
              if (isset($_POST['uitlog'])) {
                session_start();
                session_destroy();
                header("location:login.php");
                exit();
              }
              ?>
            </li>
          </ul>
    </header>
    <?php 
      elseif($_SERVER['REQUEST_URI']) : ?>
        <header class="header">
          <div class="header-container">
            <nav class="nav">
              <ul class="nav-list">
                <li class="nav-item">
                  <a href="login.php">Inloggen</a></li>
                </li>
                <li><?php endif;
                  ?>
                </li>
              </ul>
        </header>



              <style>
                .header {
                background-color: #f2f2f2;
                padding: 10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
              
              }
              
              .header-container {
                display: flex;
                align-items: right;
                justify-content: space-between;
              }
              
              .nav-list {
                list-style: none;
                margin: 0;
                padding: 0;
              }
              
              .nav-item {
                display: inline-block;
                margin-right: 10px;
              }
              
              .nav-item a {
                text-decoration: none;
                color: #333;
                padding: 5px 10px;
                border-radius: 3px;
                transition: background-color 0.3s ease;
              }
              
              .nav-item a:hover {
                background-color: #333;
                color: #fff;
              }
              
              .nav-item form {
                display: inline-block;
                margin: 0;
              }
              
              .nav-item button {
                border: none;
                background-color: transparent;
                color: #333;
                cursor: pointer;
                padding: 5px 10px;
                border-radius: 3px;
                transition: background-color 0.3s ease;
              }
              
              .nav-item button:hover {
                background-color: #333;
                color: #fff;
              }
              
              </style>

























