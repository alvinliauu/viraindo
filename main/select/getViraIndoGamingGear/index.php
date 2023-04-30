<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoGamingGear.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new getViraIndoGamingGear($db);
    $stmt = $items->getViraIndoGamingGear();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $productArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $item_id,
                "name" => $item_name,
                "price" => $item_new_price,
                "picture" => array(
                    "url" => $item_picture
                )
            );
            array_push($productArr, $e);
        }
        echo json_encode($productArr);
    }
    //nanti ganti try catch
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>