<?php

namespace Helloprint;

use Helloprint\AmqpConnector;
use Helloprint\Configuration;
use Helloprint\Utils;
use Helloprint\Db\DBHandler;
use Helloprint\Services\UserService;

use \PhpAmqpLib\Message\AMQPMessage;

class AmqpRpasswordConsumer extends AmqpConsumer {
    
    public function work() {
        $this->consume( 
            $this->queue_name, function( $msg ) {
                $this->process( $msg );   //pass as callback
            }
        );
    }
    
    public function process( $message ) {
        echo " [x] received " . $message->body . " message. processing ...\n";
        
        try {
            $user = json_decode( $message->body, true );
            $new_password = Utils::generate_password();
            
            $service = new UserService( DBHandler::get_instance() );
            $update = $service->update_password( $user["id"], $new_password );
            
            if ( !$update ) {
                throw new Exception( "unable to update user password" );
            }
            
            echo " [x] updated password for " . $user["username"] . " . new password is " . $new_password . "\n";
            
            //add user password request email to queue
            $this->queue_user_password_email( array( "username" => $user["username"], "email" => $user["email"] ) );
            
        } catch( \Exception $e ) {
            echo " [ERROR] problem processing message: " . $e->getMessage() . "\n";
        }
        
        echo " [x] finished processing message. resuming ...\n";
    }
    
    protected function queue_user_password_email( $obj ) {
        try {
            $queue = new AmqpConnector();
            $msg = new AMQPMessage( json_encode( $obj ) );
            
            //publish message to rpassword queue
            $queue->channel->basic_publish( 
                $msg, 
                "",
                Configuration::QUEUE_EMAILSENDER
            );
            
            $queue->close();
        } catch( \Exception $e ) {
            echo " [ERROR] problem adding to mail queue: " . $e->getMessage() . "\n";
        }
        
        echo " [x] new password will be sent to " . $obj["email"] . "\n";
        
        return true;
    }
}