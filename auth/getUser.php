<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/classes/Database.php';
require __DIR__.'/AuthMiddleware.php';

$allHeaders = getallheaders();
if (isset($_SERVER['Authorization'])) {
    $cTokenFromClient = trim($_SERVER['Authorization']);
} else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
    $cTokenFromClient = trim($_SERVER["HTTP_AUTHORIZATION"]);
} else if (function_exists('apache_request_headers')) {
    $requestHeaders = apache_request_headers();
    $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
    if (isset($requestHeaders['Authorization'])) {
        $cTokenFromClient = trim($requestHeaders['Authorization']);
    }
}
print_r($cTokenFromClient);die();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$auth = new Auth($conn, $allHeaders);

$valid = json_decode(json_encode($auth->isValid()), true);

if($valid["success"] == 1){
    print_r("true");
} else {
    print_r("false");
};