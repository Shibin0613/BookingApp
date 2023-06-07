<?php
$result = "";
if (
  isset($_POST['number1']) &&
  isset($_POST['number2']) &&
  isset($_POST['number3']) &&
  isset($_POST['priceAdults']) &&
  isset($_POST['priceKids']) &&
  isset($_POST['priceBaby'])
) {
  $number1 = intval($_POST['number1']);
  $number2 = intval($_POST['number2']);
  $number3 = intval($_POST['number3']);
  $priceAdults = intval($_POST['priceAdults']);
  $priceKids = intval($_POST['priceKids']);
  $priceBaby = intval($_POST['priceBaby']);

  // Perform your calculations using $inputNumber and $priceAdults

  // For example, let's multiply the input number by the price adults
  $result1 = $number1 * $priceAdults;
  $result2 = $number2 * $priceKids;
  $result3 = $number3 * $priceBaby;
  
  $result = $result1 + $result2 + $result3; 

  echo $result;
}
?>