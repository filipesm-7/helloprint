<?php

namespace Helloprint\Controllers;

use HelloPrint\Models\UserModel;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class UserController {
	
	private $model;
	
	public function __construct( UserModel $model ) {
		$this->model = $model;
	}
	
	public function login( $username, $password ){
		$filters = array( 
			":password" => $password,
			":status" 	=> 1
		);
		return $this->model->get_user( $username, $filters );
	}
    
    public function request_password( $username ) {
    }
}