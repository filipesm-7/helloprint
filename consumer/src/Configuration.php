<?php

namespace Helloprint;

class Configuration {

    const QUEUE_RPASSWORD = "rpassword";
    const QUEUE_LOGIN = "login";
    const QUEUE_EMAILSENDER = "email";
    
    const EMAIL_SERVER_NAME = "localhost";
    const EMAIL_SENDER = "helloprint@localhost.com";
    
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