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
            console.log("Returned from ajax.php and removed item from  superglobal.");
            window.location.href=window.location.href;
        });

        
    });

    $("#orderForm").submit(function(e) {
        var j = 0;
        $.each($('.amount'),function() {
            if ($(this).val() <= 0) {
                j++;
            }
        });
        if (j > 0) {
            alert('Choose an amount for all books in your cart.');
            e.preventDefault();
        }
        var adr = $("#address").val();
        //var patternAddr = /^[a-z ,.'-]+[A-z]?[1-9]{1}[0-9]*\s[1-9]{2}[0-9]{3}\s[a-z ,.'-]+$/; //Beogradska 6 11000 Beograd
        var patternAddr = /^[A-z]{5,32}/;
        if (!patternAddr.test(adr)) {
            alert('addr not good');
            e.preventDefault();
        }
            
    });
    

});