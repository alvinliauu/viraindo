<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// require __DIR__.'/classes/Database.php';
// require __DIR__.'/AuthMiddleware.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/connection/databaseconnect.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/auth/AuthMiddleware.php';

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->getConnection();
$auth = new Auth($conn, $allHeaders);

$valid =  json_decode(json_encode($auth->isValid()), true);

if($valid["success"] == 1){
    print_r(json_encode($valid));
} else {
    print_r("false");
};