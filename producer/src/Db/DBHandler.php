<?php

namespace Helloprint\Db;

use Helloprint\Configuration;

class DBHandler {
	
	public static function get_instance()
    {
        static $instance = null;
        if ( $instance === null ) {
            $instance = new DBHandler();
        }
        return $instance;
    }
	
	public function init_connection() {
		$dbh = null;
        
		try {
			$dbh = new \PDO(
				Configuration::$DB["DNS"],
				Configuration::$DB["USER"], 
				Configuration::$DB["PASSWORD"]
			);
			
			if ( $dbh == null ) {
				throw new \Exception( "could not connect to database" );
			}
		} catch ( \PDOException $e ) { }
		
		return $dbh;
	}

    private function __construct() { }
}