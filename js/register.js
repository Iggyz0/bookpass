console.log("JS connected");

$(document).ready(function(){
    console.log('jQuery connected');
    
    /*$("#email").keyup(function(){
        var generatedNickname = $name.substring(1) + $surname.substring(1)
        $("#generateNickname").val(generatedNickname);
     });
    */
    
    $("#regForm").submit(function(e) {
        var errors=[];
	
        var name = document.querySelector("#name").value;
        var surname = document.querySelector("#surname").value;
        var date = document.querySelector("#dateOfBirth").value;
        var email = document.querySelector("#email").value;

        var username = document.querySelector("#username").value;
        var password = document.querySelector("#pwd").value;
        var passwordConfirm = document.querySelector("#pwdC").value;
        
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        
        var patternName = /^[A-Z][a-z]{2,25}$/;
        var patternSurname = /^[A-Z][a-z]{2,25}$/;
        var patternEmail = /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;
        var patternPassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;

        /*
        Pass. must contain: 
            At least 1 upper and lowercase char
            At least 1 digit
            At least one special character (space, #, !, ...)
            Minimum length is 8 characters
        */

        if(patternName.test(name)){
            console.log("Name good.");
        }
        else{
            errors.push("Name not entered properly.");
        }

        if(patternSurname.test(surname)){
            console.log("Surname good.");
        }
        else{
            errors.push("Surname not entered properly.");
        }

        if(username.length < 7)
            errors.push("username not entered properly.");
        

        if(patternEmail.test(email)){
            console.log("Email good.");
        }
        else{
            errors.push("E-mail not entered properly.");
        }

        if(patternPassword.test(password)){
            console.log("Password good.");
        }
        else{
            errors.push("Password does not contain all the needed characters.");
        }

        if(password!=passwordConfirm) {
            errors.push("Passwords do not match.");
        }
        else{
            console.log("Passwords match.")
        }
        
        if (date == "" || (currentYear - date.substr(0,4)) < 17 ) {
            errors.push("Date of birth invalid.");
            //must be older than 17
        }
        else {
            console.log("Date of birth ok.")
        }

        if (document.querySelector("#agree").checked) {
            console.log("Privacy Policy accepted.")
        }
        else {
            errors.push("Privacy Policy not accepted.");
        }

        //----- Errors check
        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join("\n"));
            return;
        }
    });
    

    

});