<?php

namespace Helloprint;

class Configuration {
    
    //api request actions
    const REQUEST_LOGON = "logon";
    const REQUEST_REQUESTPASSWORD = "request_password";
    
    //request password queue namespace
    const QUEUE_RPASSWORD = "rpassword";
    
    //db configuration
    static $DB = array (
        "DNS"           => "mysql:dbname=helloprint;host=127.0.0.1",
        "USER"          => "hprint",
        "PASSWORD"      => "12345"
    );
    
    //rabbitmq configuration
    static $QUEUE = array (
        "SERVER"        => "localhost",
        "PORT"          => "5672",
        "USER"          => "guest",
        "PASS"          => "guest"
    );
}