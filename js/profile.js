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

    $("#updateButton").click(function(e) {
        e.preventDefault();
        $('input[type=file]').toggle();
        $(".toggleInput").toggle();
        $("#updateSubmit").toggle();
        
        $(this).text( $(this).text() == 'Show more' ? 'Show less' : 'Show more' );
    });

    $("#memberInfoForm").submit(function(e) {
        var errors=[];

        var username = document.querySelector("#newusername").value;
        var email = document.querySelector("#newemail").value;
        var password = document.querySelector("#newpassword").value;
        var filename = $('input[type=file]').val().split('\\').pop();

        var patternEmail = /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;
        var patternPassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
        var imgPattern = /\.(gif|jpe?g|tiff|png|webp|bmp)$/i;

        /*
        Pass. must contain: 
            At least 1 upper and lowercase char
            At least 1 digit
            At least one special character (space, #, !, ...)
            Minimum length is 8 characters
        */

        if (username.length == 0 && email.length == 0 && password.length == 0 && filename.length == 0) {
            e.preventDefault();
            errors.push("Nothing to update.");
        } 
        

        if(!patternEmail.test(email) && !email.length == 0 && !patternPassword.test(password) && !password.length == 0 && !username.length == 0 && !imgPattern.test(filename) && !filename.length == 0)
            e.preventDefault();

        /*    
        if(patternEmail.test(email)){
            console.log("Email good.");
        }
        else{
            errors.push("Email not entered properly.");
        }
        

        if(patternPassword.test(password)){
            console.log("Pwd good.");
        }
        else{
            errors.push("Pwd not entered properly.");
        }
        */

        //----- Errors check
        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join("\n"));
            return;
        }

    });

});