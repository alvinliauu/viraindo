<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../connection/databaseconnect.php';
include_once '../../../controller/delete/deleteViraIndoItem.php';

$database = new Database();
$db = $database->getConnection();
$item = new deleteViraIndoItem($db);

$stmt = $item->deleteViraIndoItem();
$itemCount = $stmt->rowCount();

$msg = array();

if ($itemCount > 0) {

    $msg = array(
        "message" => "the item successfully deleted",
        "code" => 200
    );

    echo json_encode($msg);
} else {
    header("HTTP/1.0 404 Not Found");
    $msg = array(
        "message" => "nothing deleted",
        "code" => 404
    );

    echo json_encode($msg);
}
