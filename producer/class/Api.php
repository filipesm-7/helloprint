<?php

require_once 'ApiResponse.php';
require_once 'DBHandler.php';
require_once dirname( __FILE__ ) . '/../models/UserModel.php';
require_once dirname( __FILE__ ) . '/../controllers/UserController.php';

class Api {
	
	private $response;
	
	public function __construct() {}
	
	public function get_response() {
		return $this->response;
	}
	
	public function set_response( ApiResponse $response ){
		$this->response = $response;
	}
	
	public function execute( $action, $params ){
		$this->response = new ApiResponse( "401", "unknown action" );
		
		switch ( $action ) {
			case "logon": {
				$dbh = DBHandler::get_instance();
				$user = new UserController (
					new UserModel( $dbh )
				);
				
				$result = $user->login( $params["username"], $params["password"] );

				$successful = !empty( $result );
				$this->response->set_status( $successful ? "200" : "401" );
				$this->response->set_message( $successful ? "login successful" : "user does not exist"  );
                
                break;
			}
            case "request_password": {
                $dbh = DBHandler::get_instance();
				$user = new UserController (
					new UserModel( $dbh )
				);
                
                $result = $user->request_password( $params["username"] );
                
                $successful = !empty( $result );
				$this->response->set_status( $successful ? "200" : "401" );
				$this->response->set_message( $successful ? "password request made - you will receive an email shortly" : "unable to request password, please try again"  );
                
                break;
            }
		}
	}
}