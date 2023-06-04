<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/repository/filterForSearch.php';

    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoSearchPage.php';

    $database = new Database();
    $db = $database->getConnection();

    $jsonInput = json_decode(file_get_contents("php://input"), true);
    $name = $jsonInput['name'];
    $filter = $jsonInput['filter'];
    $price = $jsonInput['price'];

    if(isset($filter)){
        if(empty($filter)){
            $arr[] = "";
        } else {
            foreach ($filter as $filt){
                $filter = $filt["name"];
                
                $arr[] = $filter;
            }
        }
    }

    if($price == ""){
        $price = "asc";
    }
    
    $item = new getViraIndoSearchPage($db, $name, $arr, $price);
    
    $stmt = $item->getViraIndoItemFilter();
    $itemCount = $stmt->rowCount();

    $productArr = array();
    $results = array();
    $arrOfCatFilter = array();

    if($itemCount > 0){
    

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // create array
            extract($row);

            $theArray = array("id" => $item_id, "name" => $item_name, "price" => $item_new_price, "image" => array("url" => $item_picture, "alt" => "viraindo"));

            array_push($results, $theArray);
            
        }

        $category = array(
            "template" => 1,
            "name" => filterForSearch($arr)
        );

        if($price == null){
            $sorting = array(
                "template" => 2,
                "name" => "Sort By Default"
            );
        } else {
            $sorting = array(
                "template" => 2,
                "name" => $price
            );
        }

        array_push($arrOfCatFilter, $category, $sorting);

        $e = array(
            "filter" => $arrOfCatFilter,
            "keyword" => $name,
            "count" => $itemCount,
            "item" => $results
        );
        array_push($productArr, $e);
      
        http_response_code(200);
        
        echo json_encode($productArr);
    }
      
    else{

        // $stmtElse = $item->getViraIndoItemFilterItemNull();
        // while($row = $stmtElse->fetch(PDO::FETCH_ASSOC)){
            // create array
            // extract($row);

            $results = [];

            $category = array(
                "template" => 1,
                "name" => filterForSearch($arr)
            );
    
            if($price == null){
                $sorting = array(
                    "template" => 2,
                    "name" => "Sort By Default"
                );
            } else {
                $sorting = array(
                    "template" => 2,
                    "name" => $price
                );
            }
    
            array_push($arrOfCatFilter, $category, $sorting);

            $e = array(
                "filter" => $arrOfCatFilter,
                "keyword" => $name,
                "count" => $itemCount,
                "item" => $results
            );
            
            http_response_code(200);
        // }
        array_push($productArr, $e);

        echo json_encode($productArr);
    }
?>