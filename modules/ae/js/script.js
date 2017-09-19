var globalAEJS;
var state = 'none';

function flowHandler(event) {
    console.log("FLOW HANDLER");
	console.log(event);

	if (event.step == 'required-fields') {
		$('#signup').hide();
		$('#additional-data').show();
	}     
}
function windowHandler(event) {
	console.log("WINDOW HANDLER");
    console.log(event);
}
function loginHandler(user,type,sso) {
	console.log("LOGIN HANDLER:"+type);
    console.log(user);
    console.log(sso);
    alert("SIGNED UP. THANKS.");
     $("#loggedin").show(); //allow logout
     
    //$("#additional-data-form").off('submit'); //remove AE handlers
    //$("#additional-data-form").attr('action', "sony_sample_handler.php?MemberID="+user.data.ID); //set local handler url
	//$("#additional-data-form").submit(); //data already saved to AE - submit form to a local handler
}
function userHandler(user,state) {
	console.log("USER HANDLER");
    console.log(user);
    console.log(state);
    
    $("#loggedin").show(); //allow logout

    if (state == 'update') {
    	$("#additional-data-form").off('submit'); //remove AE handlers
    	$("#additional-data-form").attr('action', "sony_sample_handler.php"); //set local handler url
		$("#additional-data-form").submit(); //data already saved to AE - submit form to a local handler
	}   
}
function logoutHandler(user) {
	console.log("LOGOUT HANDLER");
    console.log(user);
    alert("LOGGED OUT. THANKS.")
    $("#loggedin").hide();
    $( "a.ae-btn" ).each(function( index ) {
  		$( this ).removeClass('active');
	});
}

function AEJSReady(aeJS) {

	globalAEJS = aeJS;

	console.log("AEJS READY, hello world");
	
	aeJS.settings['auth_window'] = true;
	aeJS.settings['services'] = 'spotify,facebook,twitter,email';

    aeJS.settings['extra_fields_screen'] = 'disabled'; //custom handling
    aeJS.settings['extra_fields'] = {
		gender: { 'required': true },
		birthdate: { 'required': true },
	}

	aeJS.events.onFlow.addHandler(flowHandler);
	aeJS.events.onLogin.addHandler(loginHandler);
	aeJS.events.onUser.addHandler(userHandler);
	aeJS.events.onLogout.addHandler(logoutHandler);
	aeJS.events.onWindow.addHandler(windowHandler);

}