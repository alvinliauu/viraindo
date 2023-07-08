<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../connection/databaseconnect.php';
include_once '../../../controller/update/updateViraIndoItemName.php';

$database = new Database();
$db = $database->getConnection();
$item = new updateViraIndoItemName($db);

$stmt = $item->updateViraIndoItemName();
$itemCount = $stmt->rowCount();

$msg = array();

if ($itemCount > 0) {

    $msg = array(
        "message" => "the item name successfully updated",
        "code" => 200
    );

    echo json_encode($msg);
} else {
    header("HTTP/1.0 404 Not Found");
    $msg = array(
        "message" => "nothing updated",
        "code" => 404
    );

    echo json_encode($msg);
}
