<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/repository/filter.php';

    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoCategoryFilter.php';

    $database = new Database();
    $db = $database->getConnection();
    $item = new getViraIndoCategoryFilter($db);

    $stmt = $item->getViraIndoCategoryFilter();
    $itemCount = $stmt->rowCount();
    $productArr = array();

    if($itemCount > 0){
        
        // $productArr["list"] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // create array
            extract($row);

            // print_r($row);
            $explodeItemId = explode("$^$", $row['item_id']);
            $explodeItemName = explode("$^$", $row['item_name']);
            $explodeItemPrice = explode("$^$", $row['item_price']);
            $explodeItemPicture = explode("$^$", $row['item_picture']);

            $results = [];
            foreach ($explodeItemName as $key => $value) {

                $val = $explodeItemPrice[$key];
                $itemPict = $explodeItemPicture[$key];
                $itemId = $explodeItemId[$key];

                $theArray = array("id" => $itemId, "name" => $value, "price" => $val, "image" => array("url" => $itemPict));

                array_push($results, $theArray);
            
            }


            print_r("test");
            die();
            $e = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name,
                "filter" => filter($category_name),
                "item" => $results
            );
            array_push($productArr, $e);
          
            http_response_code(200);
        }

        echo json_encode($productArr);
    }
      
    else{
        http_response_code(404);
        echo json_encode($productArr);
    }
?>