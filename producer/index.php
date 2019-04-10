<?php

if ( $_SERVER["REQUEST_METHOD"] != "POST" ) {
	header( "HTTP/1.0 404 Not Found" );
	die();
}

//set http response headers
header( "Content-Type: application/json" );
header( "Access-Control-Allow-Origin: *");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit; // OPTIONS request wants only the policy
}

//load autoload and configuration
require_once dirname( __FILE__ ) . '/vendor/autoload.php';

if( empty( $_REQUEST["username"] ) ) {
	header( "HTTP/1.0 401; Content-Type: application/json" );
	die( json_encode( array ( "status" => "401", "message" => "username required" ) ) );
}

try {
	$api = new Helloprint\Api();
	$api->execute( $_REQUEST["action"], $_REQUEST );
} catch ( Exception $e ) {
}

$response = $api->get_response();
$result = array(
	"status" 	=> $response->get_status(),
	"message"	=> $response->get_message(),
	"data"		=> $response->get_data()
);

echo json_encode( $result );