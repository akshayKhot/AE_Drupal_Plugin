var globalAEJS;
var createLocalUser;
var signInLocalUser;
var state = 'none';

//email verification
var verify_email;
var hasVerifiedEmail;

//password reset
var service_id;
var reset_email;

function flowHandler(event) {
    console.log("FLOW HANDLER ");
    console.log(event);

    switch (event.step) {
        case 'required-fields':
            $('#signup').hide();
            $('#additional-data').show();
            break;
        case 'error':
            alert(event.error);
            break;
        case 'verify-email':
            var url = window.location.search;
            if(url != '' && url.match("send-email-ok").length > 0)
                hasVerifiedEmail = true;
            if(!verify_email && !hasVerifiedEmail) {
                globalAEJS.trigger.send_verify_email("http://drupal-plugin.appreciationengine.com/", globalAEJS.user.data.Email, {
                    'subject': 'Email Subject',
                    'body': 'Body text in email',
                    'label': 'Return link label'
                });
                hasVerifiedEmail = true;
            }
            break;
    }
}

function loginHandler(user,type,sso) {
    console.log("LOGIN HANDLER:"+type);
    $.ajax({
        url: '/ae/ajax/' + user.data.ID + '/' + createLocalUser + '/' + signInLocalUser,
        method: 'GET',
        success: function(data) {
            if(signInLocalUser)
                window.location.href = "http://drupal-plugin.appreciationengine.com/";
        }
    });

}

function userHandler(user,state) {
    console.log("USER HANDLER");
    $("#signup").hide();
    $("#greetUser").toggle();
    $("#registerlogin").toggle();
    $("#loggedInUser").text("Akshay");

    var $logout = $( "a[data-drupal-link-system-path='user/logout']" );
    $logout
        .removeAttr( "data-drupal-link-system-path" )
        .attr({
            "data-ae-logout-link": true,
            "href": "#"
        });
    globalAEJS.trigger.attach($logout);

    if (state === 'update') {
        jQuery("#additional-data-form").hide();
    }

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
}

function logoutHandler(user) {
    window.location =  "http://drupal-plugin.appreciationengine.com/user/logout";
}


function changePassword() {
    var password = document.getElementById('p1').value;
    globalAEJS.trigger.reset_password(service_id, reset_email, password);
}

