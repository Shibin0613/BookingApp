
let allCheckboxes = document.querySelectorAll('input[type=checkbox]');
let allPlayers = Array.from(document.querySelectorAll('.player'));
let checked = {};

getChecked('startingReserves');
getChecked('injured');
getChecked('position');
getChecked('nbaTeam');
getChecked('conference');

Array.prototype.forEach.call(allCheckboxes, function (el) {
  el.addEventListener('change', toggleCheckbox);
});

function toggleCheckbox(e) {
  getChecked(e.target.name);
  setVisibility();
}

function getChecked(name) {
  checked[name] = Array.from(document.querySelectorAll('input[name=' + name + ']:checked')).map(function (el) {
    return el.value;
  });
}

function setVisibility() {
  allPlayers.map(function (el) {
    var startingReserves = checked.startingReserves.length ? _.intersection(Array.from(el.classList), checked.startingReserves).length : true;
    var injured = checked.injured.length ? _.intersection(Array.from(el.classList), checked.injured).length : true;
    var position = checked.position.length ? _.intersection(Array.from(el.classList), checked.position).length : true;
    var nbaTeam = checked.nbaTeam.length ? _.intersection(Array.from(el.classList), checked.nbaTeam).length : true;
    var conference = checked.conference.length ? _.intersection(Array.from(el.classList), checked.conference).length : true;
    if (startingReserves && injured && position && nbaTeam && conference) {
      el.style.display = 'block';
    } else {
      el.style.display = 'none';
    }
  });
}