<?php

require_once dirname( __FILE__ ) . '/../class/DBHandler.php';

class UserModel {
	
	private $dbh;
	
	public function __construct( $dbh ) {
		$this->dbh = $dbh;
	}
	
	public function get_dbh() {
		return $this->dbh;
	}
	
	public function get_user( $username ){
		$pdo = $this->dbh->init_connection();
		
		$sql = "SELECT * FROM users WHERE username = :username";
		$sth = $pdo->prepare( $sql );
		$sth->execute( array( ":username" => $username ) );
		
		return $sth->fetch();
	}
}