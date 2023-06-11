<?php
require_once "../vendor/autoload.php";

use Controllers\DB;

DB::connect();

require_once "../Classes/AccommodationClass.php";
require_once '../Classes/BookingClass.php';

$AccommodationClass = new Accommodation();
$BookingClass = new Booking();

$filterArray = [];
$betweenArray = [];
$bookedArray = [];

$startDate = $_GET['startdate'];
$endDate = $_GET['enddate']; 

function removeMatchingObjects($firstArray, $secondArray) {
    $ids = array_column($firstArray, 'accommodationId');

    $filteredArray = array_filter($secondArray, function ($obj) use ($ids) {
        return !in_array($obj->id, $ids);
    });

    return array_values($filteredArray);
}


if (isset($_GET['minimumprice']) && trim($_GET['minimumprice']) !== "") {
    $betweenArray['priceAdults'] = $_GET['minimumprice'];
} else {
    $betweenArray['priceAdults'] = 0;
}
if (isset($_GET['maximumprice']) && trim($_GET['maximumprice']) !== "") {
    $betweenArray['priceAdultMaximum'] = $_GET['maximumprice'];
} else {
    $betweenArray['priceAdultMaximum'] = 10000;
}
if (isset($_GET['category']) && trim($_GET['category']) !== "") {
    $filterArray['category'] = $_GET['category'];
}

// Update the filterArray for gas, water, and electricity
if (isset($_GET['gas']) && $_GET['gas'] == 1) {
    $filterArray['gas'] = 1;
} else {
    $filterArray['gas'] = 0;
}
if (isset($_GET['water']) && $_GET['water'] == 1) {
    $filterArray['water'] = 1;
} else {
    $filterArray['water'] = 0;
}
if (isset($_GET['electricity']) && $_GET['electricity'] == 1) {
    $filterArray['electricity'] = 1;
} else {
    $filterArray['electricity'] = 0;
}
if (!empty($startDate) && !empty($endDate)) {

    $extra = 'WHERE checkInDate BETWEEN "' . $startDate . '" AND "' . $endDate . '" OR checkOutDate BETWEEN "' . $startDate . '" AND "' . $endDate . '"';
// echo $extra;
} else {
    $extra = '';
}

$bookedAccommodations = DB::select('booking', [], 'Booking', $extra);
$accommodations = $AccommodationClass->readAccommodation($filterArray, $betweenArray);

$filteredSecondObject = removeMatchingObjects($bookedAccommodations, $accommodations);
// echo "<pre>", print_r($bookedAccommodations), "</pre>";
// echo "<pre>", print_r($accommodations), "</pre>";

// echo "<pre>", print_r($filteredSecondObject), "</pre>";
ob_start(); // Start output buffering
$filteredSecondObjectLength = count($filteredSecondObject);
for ($i = 0; $i < $filteredSecondObjectLength; $i++) :
    if(isset($filteredSecondObject[$i]->images[0]))
    {
        $image = $filteredSecondObject[$i]->images[0];
        echo "
    <div class='accommodation'>
        <div class='image'><img src='$image->photo '></div>
        ";
    }
        ?>
        <div class="info">
            <input hidden name="accommodationid" value="<?= $filteredSecondObject[$i]->id ?>">
            <h2><?= $filteredSecondObject[$i]->name ?></h2>
            <p>Prijs: <?= $filteredSecondObject[$i]->priceAdults ?></p>
            <p><?= $filteredSecondObject[$i]->description ?></p>
            <button style="float:right" class="btn btn-primary" onclick="window.location.href='booking.php?id=<?= $filteredSecondObject[$i]->id ?>'">Reserveren</button>
        </div>
    </div>
<?php endfor;

// Flush the output buffer and return the generated HTML
$html = ob_get_clean();
echo $html;
?>
