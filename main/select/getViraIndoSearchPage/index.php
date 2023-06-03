<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/repository/filter.php';

    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoSearchPage.php';

    $database = new Database();
    $db = $database->getConnection();

    $jsonInput = json_decode(file_get_contents("php://input"), true);
    $name = $jsonInput['name'];
    $price = $jsonInput['price'];

    if(isset($name)){
        if(empty($name)){
            $arr[] = "";
        } else {
            foreach ($name as $filt){
                $name = $filt["keyword"];
                
                $arr[] = $name;
            }
        }
    }

    if($price == ""){
        $price = "asc";
    }
    
    $item = new getViraIndoSearchPage($db, $arr, $price);
    
    $stmt = $item->getViraIndoItemFilter();
    $itemCount = $stmt->rowCount();

    $productArr = array();

    if($itemCount > 0){
    

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // create array
            extract($row);

            $results = [];

            $theArray = array("id" => $item_id, "name" => $item_name, "price" => $item_price, "image" => array("url" => $item_picture, "alt" => "viraindo"));

            array_push($results, $theArray);
            
            $e = array(
                "filter" => filter($category_name, $arr),
                "item" => $results
            );
            array_push($productArr, $e);
          
            http_response_code(200);
        }

        echo json_encode($productArr);
    }
      
    else{

        $stmtElse = $item->getViraIndoItemFilterItemNull();

        while($row = $stmtElse->fetch(PDO::FETCH_ASSOC)){
            // create array
            extract($row);

            $results = [];

            $e = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name,
                "filter" => filter($category_name, $arr),
                "item" => $results
            );
            
            http_response_code(200);
        }
        array_push($productArr, $e);

        echo json_encode($productArr);
    }
?>