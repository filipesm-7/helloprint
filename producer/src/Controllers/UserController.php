<?php

namespace Helloprint\Controllers;

use Helloprint\ApiException;
use Helloprint\AMQPWrapper;
use HelloPrint\Configuration;
use HelloPrint\Models\UserModel;

use \PhpAmqpLib\Message\AMQPMessage;

class UserController {
	
	private $model;
	
	public function __construct( UserModel $model ) {
		$this->model = $model;
	}
	
	public function login( $username, $password ){
		$filters = array( 
			"password" => $password,
			"status" 	=> 1
		);
		return $this->model->get_user( $username, $filters );
	}
    
    public function request_password( $username ) {
        $user = $this->model->get_user( $username, array ( "status" => 1 ) );
        
        if ( empty( $user ) ) {
            throw new ApiException( "user does not exist" );
        }
        
        try {
            $queue = new AMQPWrapper();
            
            $msg = new AMQPMessage( $user["username"] );
            $queue->channel->basic_publish( 
                $msg, 
                "",
                Configuration::REQUEST_REQUESTPASSWORD
            );
            
            $queue->close();
        } catch( \Exception $e ) {
            return false;
        }

        return true;
    }
}