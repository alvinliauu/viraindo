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
    include_once '../../../controller/select/getViraIndoProductSubCategoryForHeader.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $items = new getViraIndoProductSubCategoryForHeader($db);
    $stmt = $items->getViraIndoProductSubCategoryForHeader();
    $itemCount = $stmt->rowCount();
    
    if($itemCount > 0){
        
        $productArr = array();
        $productArr["values"] = array();
        
        // while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        //     extract($row);
            
        //     $EachData = new stdClass();

        //     $EachData->shopping_category_id = $row["shopping_category_id"];
        //     $EachData->shopping_category_name = $row["shopping_category_name"];
        //     $EachData->category = array(array(
        //         "category_id" => $row["category_id"],
        //         "category_name" => $row["category_name"]            
        //     ));
            

        //     array_push($productArr["values"], $EachData);
            
        // };
        
        
        
        // echo json_encode($productArr);

    

   
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $e = array(
                "shopping_category_id" => $shopping_category_id,
                "shopping_category_name" => $shopping_category_name,
                "category" => array(
                    "category_id" => $category_id,
                    "category_name" => $category_name,
                    "sub_category" => array(
                        "sub_category_id" => $sub_category_id,
                        "sub_category_name" => $sub_category_name,
                        "item" => array(
                            "item_id" => $item_id,
                            "item_name" => $item_name
                        )
                    )
                )
            );

            foreach ($row as $index => $productArr["values"]) {
                $shopCatArr = array();
                $shopCatArr["shopping_category_id"] = $index["shopping_category_id"];
            }

            

        }

        // $curl = curl_init(); 
        // curl_setopt($curl, CURLOPT_URL, $url); 
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_POST, true); 
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $e);
        // curl_exec($curl); 
        // curl_close($curl);  
    }
    //nanti ganti try catch
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>