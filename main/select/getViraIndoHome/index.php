<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoHome.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new getViraIndoHome($db);
    $stmt = $items->getViraIndoHome();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $productArr = array();
        $arrayOfGamingGears = [];
		
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $objOfGamingGears = array(
                "id" => $item_id,
                "name" => $item_name,
                "price" => $item_new_price,
                "picture" => array(
                    "url" => $item_picture
                )
            );

            array_push($arrayOfGamingGears, $objOfGamingGears);
            
        }
		$e = array(
             "name" => "Gaming Gears",
             "template" => 1,
             "content" => $arrayOfGamingGears
         	);
        array_push($productArr, $e);
		
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