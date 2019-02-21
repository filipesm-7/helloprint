<?php

class ApiResponse {
	
	private $status;
	private $message;
	private $data;
	
	public function __construct( $status="200", $message="", $data=array() ) { 
		$this->status = $status;
		$this->message = $message;
		$this->data = $data;
	}
	
	public function get_status() {
		return $this->status;
	}
	
	public function get_message() {
		return $this->message;
	}
	
	public function get_data() {
		return $this->data;
	}
	
	public function set_status( $status ){
		$this->status = $status;
	}
	
	public function set_message( $message ){
		$this->message = $message;
	}
	
	public function set_data( $data ){
		$this->data = $data;
	}
}