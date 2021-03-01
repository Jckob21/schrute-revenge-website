const timerObject = document.getElementById("timer");
var timer = timerObject.innerHTML;

var timeMeasures = timer.split(":");

let totalTime = parseInt(timeMeasures[0]) * 3600 + parseInt(timeMeasures[1]) * 60 + parseInt(timeMeasures[2]);



setInterval(function() {
    /*var hours = Math.floor((totalTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((totalTime % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((totalTime % (1000 * 60)) / 1000);*/

    let hours = Math.floor(totalTime / 3600);
    let minutes = Math.floor((totalTime - hours * 3600) / 60);
    let seconds = Math.floor(totalTime % 60);

    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    timerObject.innerHTML = hours + ":" + minutes + ":" + seconds;

    //alert(hours + ":" + minutes + ":" + seconds);

    totalTime--;
    
    
}, 1000);