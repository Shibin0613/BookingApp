<?php include "../Classes/AccommodationClass.php";
include "header.php";

$AccommodationClass = new Accommodation();
$accommodationTest = $AccommodationClass->readAccommodation([]); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Accommodatieoverzicht</title>
    <link rel="stylesheet" href="../Styles/css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="accommodations">
            <?php

            $filterArray = [];
            

            $accommodations = $AccommodationClass->readAccommodation($filterArray);
            $accommodationsLength = count($accommodations);
            for ($i = 0; $i < $accommodationsLength; $i++) :
                $image = $accommodations[$i]->images[0];
            echo "
                <div class='accommodation'>
                    <div class=image'></div>
                    <div class='info'>
                        <h2>".$accommodations[$i]->name."</h2>
                        <button style='float:right;' data-toggle='modal' data-target='#myModal'>Wijzigen</button>
                        <p>Prijs: ".$accommodations[$i]->priceAdults."</p>
                        <p>".$accommodations[$i]->description."</p>
                    </div>
                </div>
                <!-- Modal -->
  <div class='modal fade' id='myModal' role='dialog'>
    <div class='modal-dialog'>

      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <h4 class='modal-title' id='emapleModalLabel'>Taak toevoegen</h4>
          <button type='submit' name='ziek'>Ziek</button>
          <button type='submit' name='vrij'>Vrij</button>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
        </div>
        <div class='modal-body'>

          <form method='POST' action=''>
            <br>
            <p>Taak</p>
            <textarea rows='4' cols='50' name='taken'></textarea>
            <br>
            <p>Hoelang ben je daarmee bezig geweest?<br>
            </p>
            <input type='number' name='uren' required max='8'> uren
            <br>
            <p>Tags</p>
            <button type='submit'><a href='TagsOverzicht.php'>Tags</a></button>
            <br>
            <br>
            <button type='submit' name='inleveren'>Inleveren</button>
          </form>

        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        </div>
      </div>
    </div>
  </div>";
            endfor;
            ?>
        </div>
    </div>
</body>

</html>