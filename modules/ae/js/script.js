var globalAEJS;
var createLocalUser;
var signInLocalUser;
var state = 'none';


function flowHandler(event) {
    console.log("FLOW HANDLER");
    console.log(event);

    if (event.step === 'required-fields') {
        $('#signup').hide();
        $('#additional-data').show();
    }

    if (event.step === 'error') {
        alert(event.error);
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
            window.location.reload(true);
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

}

function logoutHandler(user) {
    window.location =  "http://drupal-plugin.appreciationengine.com/user/logout";
}

