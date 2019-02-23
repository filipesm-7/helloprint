<?php

namespace Helloprint;

class Configuration {
    
    const REQUEST_LOGON = "logon";
    const REQUEST_REQUESTPASSWORD = "request_password";
    
    static $DB = array (
        "DNS"           => "mysql:dbname=helloprint;host=127.0.0.1",
        "USER"          => "hprint",
        "PASSWORD"      => "12345"
    );
}