<?php

namespace Helloprint;

use Helloprint\AmqpConnector;
use Helloprint\Services\EmailService;

class AmqpEmailSenderConsumer extends AmqpConsumer {
    
    public function work() {
        $this->consume( 
            $this->queue_name, function( $msg ) {
                $this->process( $msg );
            }
        );
    }
    
    public function process( $message ) {
        echo "  \n[x] received " . $message->body . " message. processing ...\n";
        
        try {
            $user = json_decode( $message->body, true );
            
            $service = new EmailService();
            
            echo " [x] sending email to " . $user["username"] . " <" . $user["email"] . "> ...\n";
            
            $service->send_email(
                $user["email"],
                sprintf( "%s - your password has been reset ", Configuration::EMAIL_SERVER_NAME ),
                sprintf( "hi %s, <br/><br/> your new password is %s . please login with your new password", $user["username"], $user["password"] ),
                sprintf( "From: %s\r\nContent-Type: text/html; charset=ISO-8859-1\r\n", Configuration::EMAIL_SENDER ) 
            );
            
        } catch( \Exception $e ) {
            echo " [ERROR] problem processing message: " . $e->getMessage() . "\n";
        }
        
        echo " [x] message sent. resuming ...\n";
    }
}