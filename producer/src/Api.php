<?php

namespace Helloprint;

use Helloprint\ApiResponse;
use Helloprint\Db\DBHandler;
use Helloprint\Models\UserModel;
use Helloprint\Controllers\UserController;

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
        
        $controller = $this->route( $action );
        if ( $controller == null ) {
            $this->response = new ApiResponse( "401", "unknown action" );
            return;
        }
        
        $classname = (new \ReflectionClass($controller))->getShortName();
        switch ( $classname ) {
            case "UserController": {
                $message = "";
                if ( $action == Configuration::REQUEST_LOGON ) {
                    $result = $controller->login( $params["username"], $params["password"] );
                    $message = !empty( $result ) ? "login successful" : "user does not exist";
                }
                
                elseif ( $action == Configuration::REQUEST_REQUESTPASSWORD ) {
                    $result = $controller->request_password( $params["username"] );
                    $message = $result ? "password request made - you will receive an email shortly" : "unable to request password, please try again";
                }
                
                $this->response = new ApiResponse(
                    ( !empty( $result ) ? "200" : "401" ),
                    $message
                );
                break;
            }
        }
    }
    
    public function route( $action ){
        $controller = null;
        $dbh = DBHandler::get_instance();
  
        switch ( $action ) {
            case Configuration::REQUEST_LOGON:
            case Configuration::REQUEST_REQUESTPASSWORD: {
                $controller = new UserController (
                    new UserModel( $dbh )
                );
            }
        }
        return $controller;
    }
}