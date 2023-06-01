<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoItemDetail.php';

    $database = new Database();
    $db = $database->getConnection();

    $jsonInput = json_decode(file_get_contents("php://input"), true);
    $id = $jsonInput['id'];

    $item = new getViraIndoItemDetail($db, $id);
    
    $stmt = $item->getViraIndoItemDetail();
    $otherItem = $item->getViraIndoItemLainnya();
    $itemCount = $stmt->rowCount();

    $productArr = array();
    $itemDetail = array();
    $itemLainnya = array();
    $otherItemForDetail = array();
    $itemDetailArray = array();

    if($itemCount > 0){
    
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // create array
            extract($row);

            $e = array(
                "category" => $category_name,
                "subcategory" => $sub_category_name,
                "name" => $item_name,
                "price" => $item_new_price,
                "image" => array(
                    "url" => $item_picture,
                    "alt" => "viraindo"
                )
            );

            array_push($itemDetail, $e);
          
            http_response_code(200);
        }

        while($rowOfItemLainnya = $otherItem->fetch(PDO::FETCH_ASSOC)){
            // create array
            extract($rowOfItemLainnya);

            $item = array(
                "name" => $item_name,
                "price" => $item_new_price,
                "image" => array(
                    "url" => $item_picture,
                    "alt" => "viraindo"
                )
            );

            array_push($itemLainnya, $item);
          
            http_response_code(200);
        }

        $itemDetails = array(
            "template" => 1,
            "data" => $itemDetail
        );


        $otherItems = array(
            "template" => 2,
            "item" => $itemLainnya
        );



        array_push($productArr, $itemDetails, $otherItems);

        echo json_encode($productArr);
    }
      
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>