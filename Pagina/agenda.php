<!DOCTYPE html>
<html>
<head>
  <title>Weekly Agenda</title>
  <link rel="stylesheet" href="../Styles/css.css">
</head>
<body>
  <div id="agenda-container">
    <h1>Weekly Agenda</h1>
    <div id="agenda"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>
<script>
$(document).ready(function() {
  var days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

  // Generate agenda for one week
  for (var i = 0; i < days.length; i++) {
    var day = days[i];
    var events = getEventsForDay(day);

    // Create day container
    var dayContainer = $('<div class="day"></div>');

    // Add day header
    var dayHeader = $('<div class="day-header"></div>').text(day);
    dayContainer.append(dayHeader);

    // Add events
    for (var j = 0; j < events.length; j++) {
      var event = events[j];
      var eventElement = $('<div class="event"></div>').text(event);
      dayContainer.append(eventElement);
    }

    // Add day container to agenda
    $('#agenda').append(dayContainer);
  }
});

// Example function to retrieve events for a day (replace with your own logic)
function getEventsForDay(day) {
  var events = [];

  if (day === 'Monday') {
    events.push('Meeting with clients');
    events.push('Team lunch');
  } else if (day === 'Tuesday') {
    events.push('Project presentation');
  } else if (day === 'Wednesday') {
    events.push('Workshop on new technologies');
  } else if (day === 'Thursday') {
    events.push('Product demo');
    events.push('Team building activity');
  } else if (day === 'Friday') {
    events.push('Code review');
    events.push('Release planning');
  } else if (day === 'Saturday') {
    events.push('Day off');
  } else if (day === 'Sunday') {
    events.push('Relaxation time');
  }

  return events;
}
</script>
</html>
