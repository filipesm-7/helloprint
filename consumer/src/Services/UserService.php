<?php

namespace Helloprint\Services;

use HelloPrint\Db\DBHandler;

class UserService {
	
	private $dbh;
	
	public function __construct( $dbh ) {
		$this->dbh = $dbh;
	}
    
    public function update_password( $userid, $password ) {
        $pdo = $this->dbh->init_connection();
		
		$sql = "UPDATE users SET password = :password WHERE Id = :userid";
        
        $sth = $pdo->prepare( $sql );
		return $sth->execute( array ( "userid" => $userid, "password" => $password ) );	
    }
}