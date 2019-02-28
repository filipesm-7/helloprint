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
        last_requested_api_call = helloprint.PRODUCER_LOGIN_ENDPOINT;
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

//set callback function to request user status to api
var get_user_status = function( user ){
    helloprint.utils.xhttp_request(
        helloprint.PRODUCER_SERVER + helloprint.PRODUCER_ROOT_PATH + helloprint.PRODUCER_ISACTIVE_ENDPOINT.replace( "{username}", user )
    );
}
var query_user_status = undefined;
var last_requested_api_call = "";

// set observer on form-message
var target = document.getElementById( "form-message" );

// create an observer instance
var observer = new MutationObserver( function( mutations ) {
    
    //login successful, query API
    if( target.className == "text-success" && last_requested_api_call == helloprint.PRODUCER_LOGIN_ENDPOINT ) {
        var user = document.getElementById( "username" ).value;
        
        if ( undefined == query_user_status ) {
            //first login made, disable submit and set interval function to query user status until its active
            document.getElementById( "login-btn" ).disabled = true;
            
            query_user_status = setInterval( get_user_status( user ), 3000 );
        } else {
            clearInterval( query_user_status ); //stop querying API 
        }  
    }
});

// pass in the target node, as well as the observer options
observer.observe( target, { attributes: true, childList: true, characterData: true } );