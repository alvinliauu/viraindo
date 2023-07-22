<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/repository/filterForSearch.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/repository/filterForSorting.php';

    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoSearchPage.php';

    $database = new Database();
    $db = $database->getConnection();

    $jsonInput = json_decode(file_get_contents("php://input"), true);
    $name = $jsonInput['name'];
    $filter = $jsonInput['filter'];
    $sort = $jsonInput['sort'];

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

    if($sort == "" || $sort == "1"){
        $sort = 'ORDER BY TVI.item_name ASC';
        $sortcategory = "Sort A - Z";
    } elseif ($sort == "2") {
        $sort = 'ORDER BY TVI.item_name DESC';
        $sortcategory = "Sort Z - A";
    } elseif ($sort == "3") {
        $sort = 'ORDER BY TVI.item_new_price ASC';
        $sortcategory = "Price from low to high";
    } elseif ($sort == "4") {
        $sort = 'ORDER BY TVI.item_new_price DESC';
        $sortcategory = "Price from high to low";
    }
    
    $item = new getViraIndoSearchPage($db, $name, $arr, $sort);
    
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

        $sorting = array(
            "template" => 2,
            "name" => filterForSorting($price)
        );

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
    
            $sorting = array(
                "template" => 2,
                "name" => filterForSorting($sortcategory)
            );
    
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