<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../connection/databaseconnect.php';
include_once '../../../controller/insert/insertViraIndoItem.php';

$database = new Database();
$db = $database->getConnection();
$item = new insertViraIndoItem($db);

$stmt = $item->insertViraIndoItem();

if($stmt) {
    http_response_code(200);
    
    $e = array(
        "response" => "success",
        "code" => 200,
        "message" => "the item inserted"
    );
    array_push($result, $e);
} else {
    http_response_code(404);
    $e = array(
        "response" => "failed",
        "code" => 404,
        "message" => "the item failed to insert"
    );
    array_push($result, $e);
}

echo json_encode($result);
