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

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            // create array
            extract($row);
                $e = array(
                    "id" => $processor_id,
                    "name" => $processor_name
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