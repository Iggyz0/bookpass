console.log("JS connected");

$(document).ready(function(){
    console.log('jQuery connected');
    
    /*$("#email").keyup(function(){
        var generatedNickname = $name.substring(1) + $surname.substring(1)
        $("#generateNickname").val(generatedNickname);
     });
    */
    
    $("#loginForm").submit(function(e) {
        var errors=[];
	
        var username = document.querySelector("#username").value;
        var password = document.querySelector("#pwd").value;

        /*
        var patternUsername = /^$/;
        var patternPassword = /^$/;
        */
        if(username == '')
            errors.push("Username field cannot be left empty.");
        if(username.length < 4)
            errors.push("Username must contain more than 4 characters.");

        if(password == '')
            errors.push("Password field cannot be left empty.");
        if(password.length < 4)
            errors.push("Password must contain more than 4 characters");
            
        //----- Errors check
        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join("\n"));
            return;
        }
    });
    

    

});