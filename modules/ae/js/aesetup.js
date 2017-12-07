var $ = jQuery;

function AEJSReady(aeJS) {
    var options = getOptions(drupalSettings.ae);
    globalAEJS = aeJS;
    aeJS.settings['auth_window'] = options.auth_window;
    aeJS.settings['services'] = options.social_logins;
    aeJS.settings['display_error_message'] = options.display_error_message;
    aeJS.settings['email_format'] = options.email_format;
    aeJS.settings['extra_fields'] = options.extra_fields;
    aeJS.settings['extra_info'] = options.extra_info;
    aeJS.settings['flow_css'] = options.style_url;
    aeJS.settings['flow_text'] = options.flow_text;
    aeJS.settings['hide_email_form'] = options.hide_email_form;
    aeJS.settings['language'] = options.language;
    aeJS.settings['no_email'] = options.no_email;
    aeJS.settings['mobile_detect'] = options.device_detect;
    aeJS.settings['sso'] = options.sso;
    aeJS.settings['verify_email'] = options.verify_email;
    aeJS.settings['verify_email_for_login'] = options.verify_email_for_login;
    aeJS.settings['display_error_message'] = false;
    console.log(aeJS.settings);
    aeJS.events.onFlow.addHandler(flowHandler);
    aeJS.events.onLogin.addHandler(loginHandler);
    aeJS.events.onUser.addHandler(userHandler);
    aeJS.events.onLogout.addHandler(logoutHandler);
    aeJS.events.onPasswordReset.addHandler(passwordHandler);
    aeJS.events.onEmailVerify.addHandler(verificationHandler);
    replaceLinks(globalAEJS);
}



function getGlobalHeaderFooter(text) {
    return {
        global: {
            'top': {
                'text' : "",//text.header,
                'title' : 'Appreciation Engine'
            },
            'bottom': {
                'text' : "",//text.footer,
                'title' : 'Copyright @2018'
            }
        }
    }
}

function getExtraFields(fields) {

    required_fields = fields.filter(function(field) {
        return field.required === 1;
    });

    var extraFields = {};
    required_fields.forEach(function(field) {
        extraFields[field.field] = {
            label: field.alt_text,
            required: true
        }
    });

    return extraFields;
}

function toggleEmailRegistration(settings) {
    if(settings.options.social_login)
        $("#emailRegistration").hide();
    else
        $("#emailRegistration").show();
}

function isset(variable) {
    return typeof variable === "string";
}

function getOptions(aeData) {
    var fields = aeData.fields;//{{ fields|json_encode|raw }};
    var general_settings =  aeData.general_settings;//{{ general_settings|json_encode|raw }};
    var basic_options =  aeData.basic_options;//{{ basic_options|json_encode|raw }};
    var email_options =  aeData.email_options;//{{ email_options|json_encode|raw }};
    var text_options =  aeData.text_options;//{{ text_options|json_encode|raw }};
    var performance_options =  aeData.performance_options;//{{ performance_options|json_encode|raw }};

    createLocalUser = !isset(performance_options.options.not_create_user);
    signInLocalUser = !isset(performance_options.options.not_sign_in);
    verify_email = isset(email_options.options.verify_email);
    request_verification = isset(email_options.options.req_email_verify);
    toggleEmailRegistration(general_settings);

    var options = {
        'auth_window': isset(general_settings.options.auth_window),
        'social_logins': aeData.socials.toString(),
        'display_error_message': isset(general_settings.options.error_message),
        'device_detect': isset(general_settings.options.auto_detect),
        'sso': isset(general_settings.options.multi_site_login) ? 'application' : 'local',
        'no_email': isset(general_settings.options.social_login),
        'verify_email': isset(email_options.options.verify_email),
        'verify_email_for_login': isset(email_options.options.req_email_verify),
        'email_format': parseObject(email_options),
        'hide_email_form': !isset(basic_options.options.show_ep_button),
        'style_url': basic_options.style_url,
        'language': basic_options.form_validation_language, // Todo: Make it dynamic later,
        'flow_text': parseObject(text_options),
        'create_local_user': !isset(performance_options.not_create_user),
        'sign_in_local_user': !isset(performance_options.not_sign_in),
        'extra_info': getGlobalHeaderFooter(text_options),
        'extra_fields': getExtraFields(fields)
    };

    return options;
}

// parses a given object and sets values to null if they are empty string ""
function parseObject(options) {
    for(var option in options) {
        if(options[option] === "")
            delete options[option];
    }
    return options;
}

function replaceLinks(globalAEJS) {
    // replace default login and register links
    var $login = $("a:contains('Log in')");
    $login
        .attr({
            "data-ae-login-window": true,
            "href": "#"
        });

    var $register = $("a:contains('register')");
    $register
        .attr({
            "data-ae-register-window": true,
            "href": "#"
        });

    globalAEJS.trigger.attach($login);
    globalAEJS.trigger.attach($register);
}