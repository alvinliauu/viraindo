<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/repository/filter.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/repository/filterForSorting.php';

    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoCategoryFilter.php';

    $database = new Database();
    $db = $database->getConnection();

    $jsonInput = json_decode(file_get_contents("php://input"), true);
    $id = $jsonInput['id'];
    $filter = $jsonInput['filter'];
    $sort = $jsonInput['sort'];

    if(isset($filter)){
        if(empty($filter)){
            $arr[] = "";
        } else {
            foreach ($filter as $filt){
                $name = $filt["name"];
                
                $arr[] = $name;
            }
        }
    }

    if($sort == "" || $sort == "1"){
        $pricesort = "asc";
        $price = "Price from low to high";
    } elseif ($sort == "2") {
        $pricesort = "desc";
        $price = "Price from high to low";
    }

    $item = new getViraIndoCategoryFilter($db, $id, $arr, $pricesort);
    
    $stmt = $item->getViraIndoCategoryFilter();
    $itemCount = $stmt->rowCount();

    $productArr = array();
    $arrOfCatFilter = array();

    if($itemCount > 0){

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

            $category = array(
                "template" => 1,
                "name" => filter($category_name, $arr)
            );
    
            $sorting = array(
                "template" => 2,
                "name" => filterForSorting($price)
            );
            
            array_push($arrOfCatFilter, $category, $sorting);

            $e = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name,
                "filter" => $arrOfCatFilter,
                "item" => $results
            );
            array_push($productArr, $e);
          
            http_response_code(200);
        }

        echo json_encode($productArr);
    }
      
    else{

        $stmtElse = $item->getViraIndoCategoryFilterItemNull();

        while($row = $stmtElse->fetch(PDO::FETCH_ASSOC)){
            // create array
            extract($row);

            $results = [];

            $category = array(
                "template" => 1,
                "name" => filter($category_name, $arr)
            );
    
            $sorting = array(
                "template" => 2,
                "name" => filterForSorting($price)
            );
    
            array_push($arrOfCatFilter, $category, $sorting);

            $e = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name,
                "filter" => $arrOfCatFilter,
                "item" => $results
            );
            
            array_push($productArr, $e);

            http_response_code(200);
        }

        echo json_encode($productArr);
    }
?>