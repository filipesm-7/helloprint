<?php

require_once 'vendor/autoload.php';

use Helloprint\AmqpConsumerFactory;

// consumer script arguments 
$queue_name     = ( !empty( $argv[1] ) ) ? $argv[1] : "rpassword";
$num_workers    = ( !empty( $argv[2] ) ) ? $argv[2] : 1;

try {
    //get queue consumer instance
    $consumer = AmqpConsumerFactory::make( $queue_name );
    
    if ( $consumer == null ) {
        throw new \Exception( "queue does not exist" );
    }

    $channel = $consumer->connector->channel;
    
    echo "[INFO] launching workers ...\n";
    
    //launch workers
    $worker_count = 0;
    do {
        list(,,$worker_count) = $channel->queue_declare( $consumer->queue_name, false, false, false, false );
        $consumer->work();
        
        echo "[INFO] launched worker - " . $worker_count . "/" . $num_workers . " workers launched\n";
    } while ( $worker_count < $num_workers );
    
    echo "[INFO] consumer service with " . $worker_count . "  started. to exit press CTRL+C\n";
    echo "[INFO] working queue " . $consumer->queue_name . "\n";
    
    while ( count( $channel->callbacks ) ) {
        $channel->wait();
    }
} catch( \Exception $e ) {
    echo "[ERROR] queue exiting: " . $e->getMessage();
}