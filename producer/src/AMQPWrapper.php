<?php

namespace Helloprint;

use Helloprint\Configuration;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class AMQPWrapper {
    
    public $connection;
    public $channel;
    
    public function __construct() { 
        $connection = new AMQPStreamConnection(
            Configuration::$QUEUE["SERVER"], 
            Configuration::$QUEUE["PORT"], 
            Configuration::$QUEUE["USER"], 
            Configuration::$QUEUE["PASS"]
        );
        
        $this->connection = $connection;
        $this->channel = $connection->channel();
    }
    
    public function close(){
        $this->channel->close();
        $this->connection->close();
    }
}