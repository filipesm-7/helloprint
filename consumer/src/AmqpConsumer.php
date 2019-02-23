<?php

namespace Helloprint;

use Helloprint\AmqpConnector;

abstract class AmqpConsumer {
    
    public $connector;
    public $queue_name;
    
    public function __construct( AmqpConnector $connector, $queue_name ) {
        $this->connector = $connector;
        $this->queue_name = $queue_name;
    }
    
    public function consume( $queue, $callback ) {
        $this->connector->channel->basic_consume( $queue, "", false, true, false, false, $callback );
    }
    
    abstract function work();
    abstract function process( $message );
}