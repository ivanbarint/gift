var personmodal = document.getElementById('person-modal');
var addperson = document.getElementById('add-person');
var closeperson = document.getElementById('close-person');

var eventmodal = document.getElementById('event-modal');
var addevent = document.getElementById('add-event');
var closeevent = document.getElementById('close-event');

personmodal.style.display = "none";
eventmodal.style.display = "none";

addperson.onclick = function() {
    personmodal.style.display = "block";
    this.style.display = "none";
    addevent.style.display = "block";
    eventmodal.style.display = "none";
}

closeperson.onclick = function() {
    personmodal.style.display = "none";
    addperson.style.display = "block";
}

addevent.onclick = function() {
    eventmodal.style.display = "block";
    this.style.display = "none";
    addperson.style.display = "block";
    personmodal.style.display = "none";
}

closeevent.onclick = function () {
    eventmodal.style.display = "none";
    addevent.style.display = "block";
}