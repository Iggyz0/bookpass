console.log("main.js connected successfully");

//Slider -----------------------------

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function currentDiv(n) {
    showDivs(slideIndex = n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" w3-white", "");
    }
    x[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " w3-white";
}

//Slider END ----------------------------

$(document).ready(function(){

    console.log("jquery from main connected");

    $("#formSearch").submit(function(e) {
        
        var searchText = document.querySelector("#searchBar").value;

        if (searchText == "") {
            e.preventDefault();
            alert("Search field cannot be left empty.");
        }

    });

    $("#latestButton").click(function () {
        $("#howToSort").val("latest");
    });

    $("#toplistButton").click(function () {
        $("#howToSort").val("toplist");
    });

    $("#randomButton").click(function () {
        $("#howToSort").val("random");
    });

    

});