<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoProductSubCategory.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $items = new getViraIndoProductSubCategoryForHeader($db);
    $stmt = $items->getViraIndoProductCategory($category_id);
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $productArr = array();
        $productArr["values"] = array();
        $productArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "category_id" => $category_id,
                "category_name" => $category_name,
                "category_stock" => $category_stock,
                "isActive" => $isActive
            );
            array_push($productArr["body"], $e);
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