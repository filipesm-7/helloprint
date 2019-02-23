<?php

namespace Helloprint\Models;

use HelloPrint\Db\DBHandler;

class UserModel {
	
	private $dbh;
	
	public function __construct( $dbh ) {
		$this->dbh = $dbh;
	}
	
	public function get_dbh() {
		return $this->dbh;
	}
	
	public function get_user( $username, $filters=array() ){
		$pdo = $this->dbh->init_connection();
		
		$sql = "SELECT * FROM users WHERE username = :username";
		
		if ( !empty( $filters ) ) {
			foreach( $filters as $key => $value ) {
				$sql .= " AND " . $key . " = " . $key;
			}
		}
		$filters[":username"] = $username;
		
		$sth = $pdo->prepare( $sql );
		$sth->execute( $filters );
		$result = $sth->fetch();
		
		//close connection
		$pdo = null;
		
		return $result;
	}
}