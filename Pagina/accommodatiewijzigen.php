<?php
include "header.php"; 
include "../Classes/AccommodationClass.php";

$AccommodationClass = new Accommodation();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Accommodatieoverzicht</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <?php  if(isset($_SESSION['userId'])){
    // User is logged in
   
    // You can redirect the user to a different page or perform other actions here
} else {
    // User is not logged in
  header('Location:login.php');
    // Check if the login form is submitted
} ?>
</head>

<body>
    <div class="container">
        <div class="accommodations">
            <?php
            $filterArray = [];
            $betweenArray = [];

            $accommodations = $AccommodationClass->readAccommodation($filterArray, $betweenArray);
            $accommodationsLength = count($accommodations);
            for ($i = 0; $i < $accommodationsLength; $i++) :
                ?>
                <div class="accommodation">
                    <div class="info">
                        <h2><?= $accommodations[$i]->name ?></h2>
                        <p>Prijs: <?= $accommodations[$i]->priceAdults ?></p>
                        <button type="button" style="float:right;" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?=$accommodations[$i]->id?>">Wijzigen</button>
                        <p><?= $accommodations[$i]->description ?></p>
                        <form action="../Handlers/accommodationHandler.php" method="POST">
                          <input hidden name="id" value="<?php echo $accommodations[$i]->id ?>">
                          <button style="float:right;" class="btn btn-danger" name="verwijderen" onclick="return checkdelete()">Verwijderen</button>
                        </form>
                    </div>
                    
                    
                <!-- Popup -->
                <div class="modal fade" id="myModal<?=$accommodations[$i]->id?>" role="dialog">
                  <div class="modal-dialog">
                  
                    <!-- Popup content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?=$accommodations[$i]->name ?></h4>
                      </div>
                      <div class="modal-body">
                        <form action="../Handlers/accommodationHandler.php" method="POST">
                        <input hidden name="id" value="<?=$accommodations[$i]->id?>">
                        <p>Naam</p><input type="text" id="name" name="naam" value="<?=$accommodations[$i]->name?>">
                        <p>Beschrijving</p><input type="text" id="name" name="beschrijving" value="<?=$accommodations[$i]->description?>">
                        <p>Prijs 18+</p><input type="text" id="name" name="18+" value="<?=$accommodations[$i]->priceAdults?>">
                        <p>Prijs 4-18</p><input type="text" id="name" name="4-18" value="<?=$accommodations[$i]->priceKids?>">
                        <p>Prijs 0-4</p><input type="text" id="name" name="0-4" value="<?=$accommodations[$i]->priceBaby?>">
                        <p>Min</p><input type="text" id="name" name="min" value="<?=$accommodations[$i]->minimumPeople?>">
                        <p>Max</p><input type="text" id="name" name="max" value="<?=$accommodations[$i]->maximumPeople?>">
                        <button name="wijzigen">Wijziging opslaan</button>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            <?php endfor ?>
            </div>
    </div>
    
</body>

</html>

<script>
function checkdelete(){
  return confirm('Weet je zeker dat je deze accommodatie wil verwijderen?');
}
</script>