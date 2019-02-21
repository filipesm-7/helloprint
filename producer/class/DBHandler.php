<?php

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
		require_once dirname( __FILE__ ) . '/../config.php';
		
		$dbh = null;
		try {
			$dbh = new PDO(
				$helloprint_config["DNS"], 
				$helloprint_config["DBUSER"], 
				$helloprint_config["DBPASSWORD"]
			);
			
			if ( $dbh == null ) {
				throw new Exception( "could not connect to database" );
			}
		} catch ( PDOException $e ) { }
		
		return $dbh;
	}

    private function __construct() { }
}