<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src='../Javascript/fullcalendar-scheduler-6.1.7/dist/index.global.js'></script>
<?php
  // include "header.php";
  // use Controllers\DB;
  //   $table = "users"; //Welke table je insert
  //   $data = [];
  //   $result1 = DB::select($table, $data);
  //   $sql = "SELECT naam, startdatum, einddatum FROM boekingen";
  //   $stmt = $conn->query($sql);
?>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
       themeSystem: 'bootstrap5',
       initialView: 'resourceTimelineWeek',
       slotDuration: '24:00',
       timeZone: 'GMT+2',
       locale: 'nl',
       slotLabelFormat:{
        weekday: 'long',
        meridiem: false,
       },
       resourceAreaColumns: [
        {
          headerContent: 'Categorie',
          field: 'building'
        },
        {
          headerContent: 'Accommodaties',
          field: 'title'
        },
    ],
    resources: [
      
      


    ],   



    });
    calendar.render();
});
</script>
  
    
<style>

  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 50px auto;
  }

</style>
</head>
<body>

  <div id='calendar'></div>

</body>
</html>
