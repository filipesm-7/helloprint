function login( user, pass ) {
    var result = {}
    var method = "POST";
    var endpoint = helloprint.PRODUCER_SERVER + helloprint.PRODUCER_LOGIN_ENDPOINT.replace( "{username}", user );
    
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(e) {
        if ( xhr.readyState === 4 ) {
            var message = "";
            var opts = { classname: "text-danger" };
             
            if ( xhr.status === 200 ) {
                var response = JSON.parse( xhr.response );
                
                message = response.message;
                opts.classname = ( response.status == "200" ) ? "text-success" : "text-danger";
            }
            else {
                message = "problem communicating with server"
            }
            
            helloprint.utils.show_form_message( "form-message", message, opts );
        }
    }
    xhr.open( method, endpoint, true );
    xhr.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
    xhr.send( "password=" + pass );
}

function request_password() {
}

function validate_login() {
    var fusername = document.getElementById( "username" ).value;
    var fpassword = document.getElementById( "password" ).value;
    var invalid_fields = [];
    var message = "";

    if ( fusername == "" ) {
        invalid_fields.push( {"field": "username", "message": "username is required"} );
    }
    
    if ( fpassword == "" ) {
        invalid_fields.push( {"field": "password", "message": "password is required"} );
    }
    
    if( invalid_fields.length === 0 ){  //no errors, proceed to login request
        login( fusername, fpassword );
    } else {
        //add error classes to fields and update user message
        helloprint.utils.show_form_errors( invalid_fields );
        helloprint.utils.show_form_message( "form-message", invalid_fields[0].message );
    }

    return false;
}