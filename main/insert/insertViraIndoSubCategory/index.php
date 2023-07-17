<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../connection/databaseconnect.php';
include_once '../../../controller/insert/insertViraIndoSubCategory.php';

$database = new Database();
$db = $database->getConnection();
$item = new insertViraIndoSubCategory($db);

$stmt = $item->insertViraIndoSubCategory();

if($stmt == 1) {
    http_response_code(200);
    
    $e = array(
        "response" => "success",
        "code" => 200,
        "message" => "the sub category inserted"
    );

} else {
    http_response_code(404);
    $e = array(
        "response" => "failed",
        "code" => 404,
        "message" => "the sub category failed to insert"
    );

}

echo json_encode($e);
