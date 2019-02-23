<?php

if ( $_SERVER["REQUEST_METHOD"] != "POST" ) {
	header( "HTTP/1.0 404 Not Found" );
	die();
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

header( "Content-Type: application/json" );
echo json_encode( $result );