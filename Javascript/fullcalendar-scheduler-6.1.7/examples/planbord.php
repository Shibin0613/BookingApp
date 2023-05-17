<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src='../dist/index.global.js'></script>
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
    <?php
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();
    $stmt->close();

    foreach ($sql as $row) : ?>

        suggestions.push("<?php echo "$row[1]"; ?>");

    <?php endforeach ?>


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
