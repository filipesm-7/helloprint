<?php

namespace Helloprint\Services;

use HelloPrint\Db\DBHandler;

class UserService {
	
	private $dbh;
	
	public function __construct( $dbh ) {
		$this->dbh = $dbh;
	}
    
    public function update_user( $userid, $fields ) {
        $allowed_fields = array( "password", "status" );
        $update_fields = array();

        foreach( $allowed_fields as $field ) { 

            if( empty( $fields[$field] ) ){     //remove field from update if it's not whitelisted
                unset( $fields[$field] );
                continue;
            }
            
            $update_fields[] = $field . " = :" . $field;
        }
        
        if( empty( $update_fields ) ){
            return false;
        }
        $fields["userid"] = $userid;
        
        $pdo = $this->dbh->init_connection();
		
		$sql = "UPDATE users SET " . implode( ",", $update_fields ) . " WHERE Id = :userid";
        $sth = $pdo->prepare( $sql );
        
		return $sth->execute( $fields );
    }
}