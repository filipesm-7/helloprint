<?php

namespace Helloprint;

class Configuration {
    
    const REQUEST_LOGON = "logon";
    const REQUEST_REQUESTPASSWORD = "request_password";
    
    const QUEUE_RPASSWORD = "rpassword";
    const QUEUE_EMAILSENDER = "email";
    
    static $DB = array (
        "DNS"           => "mysql:dbname=helloprint;host=127.0.0.1",
        "USER"          => "hprint",
        "PASSWORD"      => "12345"
    );
    
    static $QUEUE = array (
        "SERVER"        => "localhost",
        "PORT"          => "5672",
        "USER"          => "guest",
        "PASS"          => "guest"
    );
}