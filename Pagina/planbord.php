<?php include "../Classes/BookingClass.php"; 
include "../Classes/AccommodationClass.php";
include "header.php";

$BookingClass = new Booking();
$AccommodationClass = new Accommodation();

?>
<!DOCTYPE html>
<html>
<head>
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="../node_modules/sweetalert2/dist/sweetalert2.min.css"></script>
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
    resources: [ <?php echo $AccommodationClass->readAccommodationPlanning();?> ],

    events: [<?php echo $BookingClass->readBookingPlanning();?>],
    eventClick: function(info) {
      const name = info.event._def.extendedProps.name;
      const email = info.event._def.extendedProps.email;
      const residence = info.event._def.extendedProps.residence;
      const postalCode = info.event._def.extendedProps.postalCode;

      const content = '<div>' +
                    '<h5>Naam: ' + name + '</h5>' +
                    '<h5>E-mail: ' + email + '</h5>' +
                    '<h5>Stad: ' + residence + '</h5>' +
                    '<h5>PostCode: ' + postalCode + '</h5>' +
                  '</div>';

  Swal.fire({
    html: content,
    showCancelButton: true,
  confirmButtonColor: 'green',
  cancelButtonColor: 'red',
  confirmButtonText: 'Betaald',
  cancelButtonText: 'Niet betaald',
  }).then((result) => {
    if (result.isConfirmed) {
      
    }
  })

    },
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
