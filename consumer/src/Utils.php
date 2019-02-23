<?php

namespace Helloprint;

class Utils {

    static function generate_password() {
        return bin2hex( openssl_random_pseudo_bytes( 4 ) );
    }
}