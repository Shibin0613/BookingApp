<?php
// fetch_accommodations.php
include "../Classes/AccommodationClass.php";

$AccommodationClass = new Accommodation();

if (isset($_POST['variable'])) {
  $selectedOption = $_POST['variable'];
  
  $accommodations = $AccommodationClass->readAccommodation(['category' => $selectedOption]);
  
//   $accommodationsOptions = [];
//     foreach ($accommodations as $key => $value) {
//         $accommodations[] = ['name' => $value->name, 'id' => $value->id];
//     }
  // Assume $accommodations is an array of accommodation objects
  
  
  // Return the result as JSON
  echo json_encode($accommodations);
}
?>

