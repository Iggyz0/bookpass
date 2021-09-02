console.log("main.js connected successfully");

$(document).ready(function(){

    console.log("jquery from main connected");

    $("#formSearch").submit(function(e) {
        //var errors=[];

        var searchText = document.querySelector("#searchBar").value;

        if (searchText == "") {
            e.preventDefault();
            alert("Search field cannot be left empty.");
        }

    });

    $('.sendReview').submit(function(e){
        if (!$.trim($('#textbox').val())) { // if textarea is empty or contains only white-space
            e.preventDefault();
            alert('Textarea is empty.');
        }
        else if ($.trim($('#textbox').val()).length < 10) {
            e.preventDefault();
            alert('Textarea contains too few characters. Review must contain at least 20 characters.');
        }
    });
/*
    $('.buyButton').click(function(e) {
        e.preventDefault();
        var valueAttr = $(this).attr("value"); //book
        var buttonHTML = $(this).text();
        if (buttonHTML == "Add to cart")
            $(this).text("Remove from cart");
        else 
            $(this).text("Add to cart");
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: { 'item': valueAttr, 'action': buttonHTML},
            success: function() {console.log("success")},
            error: function() {console.log("error")}
        }).done(function(data) {
            console.log("Returned from ajax.php and wrote to super global.");
        });

        
    });*/

});