(function(){
	//webserver js configuration
	if (!window.helloprint) {
		window.helloprint = {};

		helloprint.PRODUCER_SERVER = 'http://localhost/';
		helloprint.PRODUCER_LOGIN_ENDPOINT = 'helloprint/producer/user/{username}/logon';
		helloprint.PRODUCER_REQUESTPASSWORD_ENDPOINT = 'user/{username}/request-password';
        
        helloprint.utils = {
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