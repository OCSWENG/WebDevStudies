
// EVENT PROCESSING THE POST FROM SIGNUP, LOGIN, FORGOTPASSWORD

// AJAX Call for the signup Form
$("#signupForm").submit(function(event){
   // Prevent the default PHP processing
    event.preventDefault();
    
    var dataposts = $(this).serializeArray();
    
    //SEND dataposts to signup.php using AJAX
    // URL TYPE DATA if fail/success
    $.ajax({
        url: "signup.php",
        type: "POST",
        data: dataposts,
        success: function (data) {
            if ( data){
                $("#signupmessage").html(data);
            }
        },
        error: function () {
            $("#signupmessage").html("<div class='alert alter-danger'>Unable to process the signup form</div>");
        },
    }); 
});


// AJAX Call for the login form
$("#loginForm").submit(function(event){
   // prevent PHP processing
    event.preventDefault();
    
    // Get user inputs
    var dataposts = $(this).serializeArray();
    
    // send to login.php using AJAX
    $.ajax({
        url: "login.php",
        type: "POST",
        data: dataposts,
        success: function(data){
            if(data == "success") {
                window.location = "mainpageloggedin.php";
            } else {
                $("#loginmessage").html(data);
            }
        },
        fail: function(){
            $("#loginmessage").html("<div class='alert alert-danger'>An error processing the login. Try again another time.</div>")
        },
    });
});


// AJAX Call for forgotpassword
$("#forgotpasswordform").submit(function(event){
   event.preventDefault();
    var dataposts = $(this).serializeArray();
    $.ajax({
        url: "forgot-password.php",
        type: "POST",
        data: dataposts,
        success: function(data) {
            $("#forgotpasswordmessage").html(data);
        },
        fail: function() {
            $("#forgopasswordmessage").html("<div class='alert alert-danger'>An error processing the login. Try again another time.</div>");
        }
    });
});