var globalAEJS;
var createLocalUser;
var signInLocalUser;

//email verification
var verify_email;

//password reset
var service_id;
var reset_email;

function flowHandler(event) {
    console.log("FLOW HANDLER ");
    console.log(event);

    switch (event.step) {
        case 'required-fields':
            $('#signup').hide();
            $('#additional-data').show(500);
            break;
        case 'error':
            handleError(event.error);
            break;
        case 'verify-email':
            if(manualVerificationNeeded()) {
                globalAEJS.trigger.send_verify_email(window.location.origin, globalAEJS.user.data.Email, {
                    'subject': 'Email Verification for AE',
                    'body': 'Please verify your email',
                    'label': 'Email Verification'
                });
            }
            break;
        case 'verify-email-ok':
            // handle stuff after email i verified.
            break;
    }
}

function manualVerificationNeeded() {
    return !verify_email && request_verification;
}

function loginHandler(user,type,sso) {
    console.log("LOGIN HANDLER:"+type);
    $.ajax({
        url: '/ae/ajax/' + user.data.ID + '/' + createLocalUser + '/' + signInLocalUser,
        method: 'GET',
        success: function(data) {
            if(signInLocalUser)
                window.location.href = window.location.origin;
        }
    });

}

function userHandler(user,state) {

    user.services.forEach(function(service) {
        if(service.Service == 'email') {
            service_id = service.ID;
            reset_email = service.VerifiedEmail;
        }
    })

}

function verificationHandler(step, data) {

    if(step === 'sent')
        alert("A verification email has been sent to: " + data.EmailAddress);
    if(step === 'verified') {
        alert("Email has been verified successfully..You will be logged in now");
        console.log("Email verified");
    }

}

function passwordHandler() {
    alert("Password was updated successfully..");
    $("#passwordUpdateForm").hide(500);
    $("#askForUpdate").show(500);
}

function logoutHandler(user) {
    window.location =  window.location.origin + "/user/logout";
}

function changePassword() {
    var password = document.getElementById('p1').value;
    globalAEJS.trigger.reset_password(service_id, reset_email, password);
}


function showUpdateForm() {
    $("#passwordUpdateForm").show(500);
    $("#askForUpdate").hide(500);
}

function cancelChangePassword() {
    $("#passwordUpdateForm").hide(500);
    $("#askForUpdate").show(500);
}

function handleError(error) {
    $("#error_ae").show();
    $("#error_ae").text(error);
}

function forgotPassword() {
    globalAEJS.trigger.verify_reset_password(window.location.origin);
}































// Review this

// function updateDisplay(user, state) {
//     $("#signup").hide();
//     $("#greetUser").show();
//     $("#registerlogin").hide();
//     $("#changePassword").show();
//     if (state === 'update')
//         $("#additional-data-form").hide();
//
//     var first_name = user.data.FirstName;
//     $("#loggedInUser").text(first_name);
// }

// function enableLogout() {
//     var $logout = $("a[data-drupal-link-system-path='user/logout']");
//     $logout
//         .removeAttr("data-drupal-link-system-path")
//         .attr({
//             "data-ae-logout-link": true,
//             "href": "#"
//         });
//     globalAEJS.trigger.attach($logout);
// }