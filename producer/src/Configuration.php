<?php

namespace Helloprint;

class Configuration {
    
    //api request actions
    const REQUEST_LOGON = "logon";
    const REQUEST_ISACTIVE = "is_active";
    const REQUEST_REQUESTPASSWORD = "request_password";
    
    //request password queue namespace
    const QUEUE_RPASSWORD = "rpassword";
    const QUEUE_LOGIN = "login";
    
    //db configuration
    static $DB = array (
        "DNS"           => "mysql:dbname=helloprint;host=mysql-db",
        "USER"          => "root",
        "PASSWORD"      => "12345"
    );
    
    //rabbitmq configuration
    static $QUEUE = array (
        "SERVER"        => "rabbitmq",
        "PORT"          => "5672",
        "USER"          => "guest",
        "PASS"          => "guest"
    );
}