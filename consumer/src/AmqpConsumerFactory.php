<?php

namespace Helloprint;

use Helloprint\Configuration;
use Helloprint\AmqpConnector;
use Helloprint\AmqpRpasswordConsumer;
use Helloprint\AmqpEmailSenderConsumer;

class AmqpConsumerFactory {
    
    public static function make( $queue_name ) { 
        $consumer = null;
        
        $connector = new AmqpConnector();
        switch ( $queue_name ) {
            case Configuration::QUEUE_RPASSWORD: {
                $consumer = new AmqpRpasswordConsumer( $connector, $queue_name );
                break;
            }
            case Configuration::QUEUE_EMAILSENDER: {
                $consumer = new AmqpEmailSenderConsumer( $connector, $queue_name );
                break;
            }
        }
        return $consumer;
    }
}