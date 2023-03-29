<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoSimulation.php';

    $database = new Database();
    $db = $database->getConnection();
    $item = new getViraIndoSimulation($db);

    $stmt = $item->getViraIndoSimulation();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $productArr = array();
        // $productArr["list"] = array();

        $data = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            
            //======================================= UNTUK NESTED ARRAY (BELUM SELESAI) ================================
            // if(!isset($data[$row['category_id']])){
            //     $data[] = [
            //         'id' => $row['category_id'],
            //         'name' => $row['category_name']
            //     ];
            // }
            // $data[$row['category_id']]['item'][] = [
            //     'id' => $row['item_id'],
            //     'name' => $row['item_name'],
            //     'price' => $row['item_new_price'],
            //     'image' => $row['item_picture']
            // ];
            //======================================= UNTUK NESTED ARRAY (BELUM SELESAI) ================================

                $e = array(
                    "id" => $item_id,
                    "name" => $item_name,
                    "price" => $item_new_price,
                    "image" => $item_picture
                );
                array_push($productArr, $e);
          
            http_response_code(200);
        }
        echo json_encode($productArr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Item not found.");
    }
?>