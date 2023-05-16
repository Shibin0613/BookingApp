<?php
include "../Classes/GuestClass.php";
include "header.php";
use Controllers\DB;

$table = "guests"; //Welke table je insert
$data = [
    'name' => "tim", //de key is de column en de value is de value van die column
];
$result1 = DB::select($table, $data, 'Guests');
echo "<pre>",print_r($result1),"<pre>";