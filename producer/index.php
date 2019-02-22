<?php

if ( $_SERVER["REQUEST_METHOD"] != "POST" ) {
	header( "HTTP/1.0 404 Not Found" );
	die();
}

require_once 'class/ApiResponse.php';

if( empty( $_REQUEST["username"] ) ) {
	header( "HTTP/1.0 401; Content-Type: application/json" );
	die( json_encode( array ( "status" => "401", "message" => "username required" ) ) );
}

require_once 'class/Api.php';

try {
	$api = new Api();
	$api->execute( $_REQUEST["action"], $_REQUEST );
} catch ( Exception $e ) {
	echo print_r( $e, 1 );
}

$response = $api->get_response();
$result = array(
	"status" 	=> $response->get_status(),
	"message"	=> $response->get_message(),
	"data"		=> $response->get_data()
);

header( "Content-Type: application/json" );
echo json_encode( $result );