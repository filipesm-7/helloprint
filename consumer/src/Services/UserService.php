<?php

namespace Helloprint\Service;

use HelloPrint\Db\DBHandler;

class UserService {
	
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
				$sql .= " AND " . $key . " = :" . $key;
			}
		}
		$filters[":username"] = $username;
        
		$sth = $pdo->prepare( $sql );
		$sth->execute( $filters );
		$result = $sth->fetch( PDO::FETCH_ASSOC );
		
		//close connection
		$pdo = null;
		
		return $result;
	}
    
    public function update_password( $userid, $password ) {
        $pdo = $this->dbh->init_connection();
		
		$sql = "UPDATE users SET password = :password WHERE userid = :userid";
        
        $sth = $pdo->prepare( $sql );
		return $sth->execute( array ( "Id" => $userid, "password" => $password ) );	
    }
}