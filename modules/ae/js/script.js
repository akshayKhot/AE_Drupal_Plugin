var globalAEJS;
var createLocalUser;
var signInLocalUser;
var state = 'none';

//password reset
var service_id;
var reset_email;

function flowHandler(event) {
    console.log("FLOW HANDLER ");
    console.log(event);

    if (event.step === 'required-fields') {
        $('#signup').hide();
        $('#additional-data').show();
    }

    if (event.step === 'error') {
        alert(event.error);
    }

    if(event.step === 'verify-email') {
        globalAEJS.trigger.send_verify_email("http://drupal-plugin.appreciationengine.com/", globalAEJS.user.data.Email, {'subject':'Email Subject',
            'body':'Body text in email',
            'label': 'Return link label'});
    }
}

function windowHandler(event) {
    console.log("WINDOW HANDLER");
    console.log(event);
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

