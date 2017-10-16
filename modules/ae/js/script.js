var globalAEJS;
var state = 'none';


function flowHandler(event) {
    console.log("FLOW HANDLER");
    console.log(event);

    if (event.step === 'required-fields') {
        $('#signup').hide();
        $('#additional-data').show();
        $("#loggedin").show();
    }
}
function windowHandler(event) {
    console.log("WINDOW HANDLER");
    console.log(event);
}
function loginHandler(user,type,sso) {
    console.log("LOGIN HANDLER:"+type);
    console.log(user);
    alert("SIGNED UP. THANKS.");
    $('#signup').hide();
    $("#loggedin").show(); //allow logout

    $.ajax({
        url: '/ae/ajax/' + user.data.ID,
        method: 'GET',
        success: function(data) {
            if(data === "1")
                window.location.reload(true);
            else {
                console.log("Here is the response");
                console.log(data);
                console.log(JSON.parse(data));
            }
        }
    });
}
function userHandler(user,state) {
    console.log("USER HANDLER");
    console.log(user);
    console.log(state);
    $('#signup').hide();
    $('#loggedin').show();

    var $logout = $('a:contains("Log out")');
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
    console.log("LOGOUT HANDLER");
    console.log(user);
    alert("LOGGED OUT. THANKS.")
    $("#loggedin").hide();
    $('#signup').show();
    $('#additional-data').hide();
    $( "a.ae-btn" ).each(function( index ) {
      $( this ).removeClass('active');
    });

    window.location =  "http://drupal-plugin.appreciationengine.com/user/logout";
}

