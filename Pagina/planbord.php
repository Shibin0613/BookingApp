<?php include "../Classes/BookingClass.php"; 
include "../Classes/AccommodationClass.php";
include "header.php";

$BookingClass = new Booking();
$AccommodationClass = new Accommodation();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src='../Javascript/fullcalendar-scheduler-6.1.7/dist/index.global.js'></script>
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
          headerContent: 'Accommodaties',
          field: 'title'
        },
    ],
    resources: [ <?=$AccommodationClass->readAccommodationPlanning();?>

      // { id: 'a', title: 'Auditorium A' },
      //   { id: 'b', title: 'Auditorium B', eventColor: 'green' },
      //   { id: 'c', title: 'Auditorium C', eventColor: 'orange' },
    ],   
    events: [<?=$BookingClass->readBookingPlanning();?>],

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
