(function(){
	//webserver js configuration
	if (!window.helloprint) {
		window.helloprint = {};

		helloprint.PRODUCER_SERVER = 'http://localhost/';
		helloprint.PRODUCER_LOGIN_ENDPOINT = 'user/{username}/login';
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
            }
        }
	}
})();