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

    $('.scorechk, .catchk').on('change', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });

    /*
    $('input[type="checkbox"]').on('change', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });
    */
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

        
    });

});