function login() {
}

function request_password() {
}

function validate_login() {
    var fusername = document.getElementById( "username" ).value;
    var fpassword = document.getElementById( "password" ).value;
    var invalid_fields = [];

    if ( fusername == "" ) {
        invalid_fields.push( {"field": "username", "message": "username is required"} );
    }
    
    if ( fpassword == "" ) {
        invalid_fields.push( {"field": "password", "message": "password is required"} );
    }
    
    if( invalid_fields.length === 0 ){  //no errors, proceed to login request
        login();
    }
    
    //add error classes to fields
    helloprint.utils.show_form_errors( invalid_fields );
    
    //show first field error message
    document.getElementById( "form-message" ).style.display = "block";
    document.getElementById( "form-message" ).className = "text-danger";
    document.getElementById( "form-message" ).textContent = invalid_fields[0].message;

    return false;
}