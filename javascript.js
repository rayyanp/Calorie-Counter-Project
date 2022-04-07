var d = new Date();
var date = d.getUTCDate();
var month = d.getUTCMonth() + 1; // Since getUTCMonth() returns month from 0-11 not 1-12
var year = d.getUTCFullYear();

var dateStr = date + "/" + month + "/" + year;
document.getElementById("date").innerHTML = dateStr;

setInterval(myTimer, 1000);

function myTimer() {
    const t = new Date();
    document.getElementById("time").innerHTML = t.toLocaleTimeString();

}


