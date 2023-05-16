<?php
include "../Classes/GuestClass.php";
include "header.php";
use Controllers\DB;

$mainTables = [
    [
        "accommodation", //Eerste table waar je een andere tabel aan toevoegt met een inner join
    ],
    [
        "id", //Dit is de column van de eerste table waar je een inner join op uitvoert    taken.id
    ]
];
$koppelTables = [
    [
        "photo", //De table die je aan de eerste main table toevoegt
    ],
    [
        ['accommodationid', '*'], //De eerste parameter is welke column je van de eerste koppeltable die je koppelt met de eerste main table. De tweede parameter is vervolgens wat je wil selecteren
    ]
];
$whereClauseMainTable = [
    [
        "accommodation.id", //de column waar je op filtert in de eerste main table
        1
    ] //de value van de eerste column waar je op filtert
];

$result4 = DB::join($mainTables[0], $mainTables[1], $koppelTables[0], $koppelTables[1], $whereClauseMainTable[0]);
echo "<pre>",print_r($result4),"<pre>";