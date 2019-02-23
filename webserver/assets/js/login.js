function login() {
    var errors = helloprint.utils.validate( ["username", "password"] );
    
    if( errors.length === 0 ){  //no errors, proceed to login request
        var user = document.getElementById( "username" ).value;
        var pass = document.getElementById( "password" ).value;
        
        helloprint.utils.xhttp_request( 
            helloprint.PRODUCER_SERVER + helloprint.PRODUCER_ROOT_PATH + helloprint.PRODUCER_LOGIN_ENDPOINT.replace( "{username}", user ), 
            "POST", 
            "password="+pass 
        );
    } else {
        //add error classes to fields and update user message
        helloprint.utils.show_form_errors( errors );
        helloprint.utils.show_form_message( "form-message", errors[0].message );
    }
    return false;
}

function request_password() {
    var errors = helloprint.utils.validate( ["username"] );
    
    if( errors.length === 0 ){
        var user = document.getElementById( "username" ).value;
        
        helloprint.utils.xhttp_request( 
            helloprint.PRODUCER_SERVER + helloprint.PRODUCER_ROOT_PATH + helloprint.PRODUCER_REQUESTPASSWORD_ENDPOINT.replace( "{username}", user )
        );
    } else {
        helloprint.utils.show_form_errors( errors );
        helloprint.utils.show_form_message( "form-message", errors[0].message );
    }
    return false;
}