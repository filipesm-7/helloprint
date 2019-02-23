<?php

namespace Helloprint\Services;

use HelloPrint\Db\DBHandler;

class EmailService {
	
	public function send_email( $email, $subject, $body, $headers ){
		try {
            mail( $email, $subject, $body, $headers );
        } catch( Exception $e ) {
            return false;
        }
        return true;
	}
}