<?php

namespace Helloprint;

use Helloprint\AmqpConnector;

class AmqpEmailSenderConsumer extends AmqpConsumer {
    
    public function work() {
        $this->consume( 
            $this->queue_name, function( $msg ) {
                $this->process( $msg );   //pass as callback
            }
        );
    }
    
    public function process( $message ) {
        /*TODO*/
    }
}