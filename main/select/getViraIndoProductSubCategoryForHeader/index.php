<?php

    /* examples json:
    {
        "values":[
            {  
                "id":1,
                "shop_cat_name":"komponen kommputer",
                "kategori":[
                    {
                        "id":"1",
                        "nama":"procesor",
                        "brand":[
                            {
                                "id":1,
                                "name":"amd",
                                "items":[
                                    {
                                        "id":"1",
                                        "name":"amd 1"
                                    },
                                    {
                                        "id":"2",
                                        "name":"amd 2"
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        ]
    }
    */

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
                "shopping_category_id" => $shopping_category_id,
                "shopping_category_name" => $shopping_category_name,
                $productArr["category"] = array(
                    "category_id" => $category_id,
                    "category_name" => $category_name,
                    $productArr["sub_category"] = array(
                        "sub_category_id" => $sub_category_id,
                        "sub_category_name" => $sub_category_name,
                        $productArr["item"] = array(
                            "item_id" => $item_id,
                            "item_name" => $item_name
                        )
                    )
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