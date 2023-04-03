<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoSimulation.php';

    $input = json_decode(file_get_contents("php://input"), true);
    $token = $input['token'];

    
    try {
        if($token == "brainli"){
            $database = new Database();
            $db = $database->getConnection();
            $item = new getViraIndoSimulation($db);

            $stmt = $item->getViraIndoSimulation();
            $itemCount = $stmt->rowCount();

            if($itemCount > 0){
                
                $productArr = array();

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);

                        $e = array(
                            "id" => $item_id,
                            "name" => $item_name,
                            "price" => $item_new_price,
                            "image" => array(
                                "url" => $item_picture
                            )
                        );
                        array_push($productArr, $e);
                
                    http_response_code(200);
                }
                echo json_encode($productArr);
            }
        }
        
        else{
            http_response_code(404);
            throw new Exception;
        }
        
    } catch (Exception $e) {
        $e->getCode();
        $e->getFile();
        $e->getMessage();
    }

    
?>