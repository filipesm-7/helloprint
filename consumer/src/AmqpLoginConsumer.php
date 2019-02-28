<?php

namespace Helloprint;

use Helloprint\AmqpConnector;
use Helloprint\Configuration;
use Helloprint\Utils;
use Helloprint\Db\DBHandler;
use Helloprint\Services\UserService;

use \PhpAmqpLib\Message\AMQPMessage;

class AmqpLoginConsumer extends AmqpConsumer {
    
    public function work() {
        $this->consume( 
            $this->queue_name, function( $msg ) {
                $this->process( $msg );   //pass as callback
            }
        );
    }
    
    public function process( $message ) {
        echo "  \n[x] received " . $message->body . " message. processing ...\n";
        
        try {
            $user = json_decode( $message->body, true );
            
            $service = new UserService( DBHandler::get_instance() );
            $update = $service->update_user( $user["id"], array( "status" => 1 ) );
            
            if ( !$update ) {
                throw new \Exception( "unable to update user password" );
            }
            
            echo " [x] updated status for " . $user["username"] . ". \n";
            
        } catch( \Exception $e ) {
            echo " [ERROR] problem processing message: " . $e->getMessage() . "\n";
        }
        
        echo " [x] finished processing message. resuming ...\n";
    }
}