(function(){
	//webserver js configuration and utilities
	if (!window.helloprint) {
		window.helloprint = {};

		helloprint.PRODUCER_SERVER = 'http://localhost/';
		helloprint.PRODUCER_LOGIN_ENDPOINT = 'helloprint/producer/user/{username}/logon';
		helloprint.PRODUCER_REQUESTPASSWORD_ENDPOINT = 'helloprint/producer/user/{username}/request-password';
        
        helloprint.utils = {
            xhttp_request: function( endpoint, method, qstring ) {
                var method = ( method != undefined ) ? method : "POST";
                var qstring = ( qstring != undefined ) ? qstring : "";     
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
                xhr.send( qstring );
            },
            show_form_errors: function( fields ) {
                var error_class = "border border-danger";
        
                for ( var i in fields ) {
                    var field = document.getElementById( fields[i].field );
                
                    //add error class if it doesn't exist
                    if ( field.className.indexOf( error_class ) === -1 ){
                        field.className += " " + error_class;
                    }
                }
            },
            show_form_message: function( element_id, message, opts ) {
                var options = ( opts != undefined ) ? opts : {};
                var defaults = { "classname": "text-danger", "show": true };
                
                //merge parameter options with default 
                options = Object.assign( {}, defaults, options );     
                
                var elem = document.getElementById( element_id );
                if( elem != null ) {
                    elem.style.display = ( options.show ) ? "block" : "none";
                    elem.className = options.classname;
                    elem.textContent = message;
                }
            }
        }
	}
})();