<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/classes/Database.php';
require __DIR__.'/AuthMiddleware.php';

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$auth = new Auth($conn, $allHeaders);
$getHeader = apache_request_headers();
print_r($getHeader);


// $valid = json_decode(json_encode($auth->isValid()), true);
print_r($auth);

print_r($allHeaders);die();



if($valid["success"] == 1){
    print_r("true");
} else {
    print_r("false");
};