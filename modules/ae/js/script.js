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
                alert("A verification email has been sent to: " + globalAEJS.user.data.Email);
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

function windowHandler(event) {
    console.log("WINDOW HANDLER");
    console.log(event);
}

function loginHandler(user,type,sso) {
    debugger;
    var temp = globalAEJS.user.data.hasOwnProperty('VerifiedEmail');
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
    console.log(user);
    console.log(state);
    $('#signup').hide();
    $('#loggedin').show();

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

