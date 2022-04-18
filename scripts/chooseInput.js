function chooseInput() {
    var i = document.getElementById("chooseInput");
        if (i.style.display === "none") {
            i.style.display = "block";
        } else {
            i.style.display = "none";
        }
}

function inputMeal() {
    var m = document.getElementById("inputMeal");
    var w = document.getElementById("inputWeight");
        if (m.style.display === "none") {
            m.style.display = "block";
            w.style.display = "none";
        } else {
            m.style.display = "none";
        }
}

function inputWeight() {
    var w = document.getElementById("inputWeight");
    var m = document.getElementById("inputMeal");
        if (w.style.display === "none") {
            w.style.display = "block";
            m.style.display = "none";
        } else {
            w.style.display = "none";
        }
}