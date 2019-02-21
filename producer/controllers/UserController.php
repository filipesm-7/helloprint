<?php

require_once dirname( __FILE__ ) . '/../models/UserModel.php';

class UserController {
	
	private $model;
	
	public function __construct( UserModel $model ) {
		$this->model = $model;
	}
	
	public function login( $username ){
		return $this->model->get_user( $username );
	}
}