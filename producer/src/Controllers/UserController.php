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
            //open queue connection
            $queue = new AMQPWrapper();
            
            //create queue message instance
            $msg = new AMQPMessage( 
                json_encode(
                    array(
                        "id"        => $user["Id"],
                        "username"  => $user["username"],
                        "email"     => $user["email"]
                    )
                ) 
            );
            
            //publish message to rpassword queue
            $queue->channel->basic_publish( 
                $msg, 
                "",
                Configuration::QUEUE_RPASSWORD
            );
            
            $queue->close();
        } catch( \Exception $e ) {
            return false;
        }

        return true;
    }
}