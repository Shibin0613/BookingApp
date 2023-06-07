<?php
// fetch_accommodations.php
include "../Classes/AccommodationClass.php";
require_once "../vendor/autoload.php";

use Controllers\DB;

DB::connect();

$AccommodationClass = new Accommodation();

if (isset($_POST['variable'])) {
  $id = $_POST['variable'];

$updatedRow = DB::update("UPDATE `booking` SET `paid` = :paid WHERE id = :id", ['paid' => 0, 'id' => $id]);
  
//   $accommodationsOptions = [];
//     foreach ($accommodations as $key => $value) {
//         $accommodations[] = ['name' => $value->name, 'id' => $value->id];
//     }
  // Assume $accommodations is an array of accommodation objects
  
  
  // Return the result as JSON
  echo json_encode($updatedRow);
}
?>

