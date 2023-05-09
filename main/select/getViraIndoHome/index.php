<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoHome.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new getViraIndoHome($db);
    $stmt = $items->getViraIndoHome();
    $underPrice = $items->getViraIndoItemUnderPrice();

    $itemCount = $stmt->rowCount();

    if($itemCount > 0 || $underPrice > 0){
        
        $productArr = array();
        $arrayOfGamingGears = [];
        $arrayOfItemUnderPrice = [];
        $imageOfBanner = [];
		
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $objOfGamingGears = array(
                "id" => $item_id,
                "name" => $item_name,
                "price" => $item_new_price,
                "image" => array(
                    "url" => $item_picture,
                    "alt" => "viraindo tokped"
                )
            );

            array_push($arrayOfGamingGears, $objOfGamingGears);
            
        }

        while ($rowOfItemUnderPrice = $underPrice->fetch(PDO::FETCH_ASSOC)){
            extract($rowOfItemUnderPrice);

            $objOfItemUnderPrice = array(
                "id" => $item_id,
                "name" => $item_name,
                "price" => $item_new_price,
                "image" => array(
                    "url" => $item_picture,
                    "alt" => "viraindo tokopedia"
                )
            );

            array_push($arrayOfItemUnderPrice, $objOfItemUnderPrice);

        }

        for($x = 1; $x <= 2; $x++){
            
            $arrayOfImageBanner = array(
                "id" => $x,
                "image" => array(
                    "url" => "https://images.tokopedia.net/img/cache/1200/BgtCLw/2022/10/6/864ae2f3-754f-48e1-a7c2-fa7fa29560fe.jpg.webp?ect=3g",
                    "alt" => "viraindo tokopedia"
                )
            );
            array_push($imageOfBanner, $arrayOfImageBanner);

        }
        

        $image = array(
            "name" => "Banner",
            "template" => 3,
            "content" => $imageOfBanner
        );

		$e = array(
            "name" => "Gaming Gears",
            "template" => 1,
            "content" => $arrayOfGamingGears
        );

        $itemUnderPrice = array(
            "name" => "Gaming Gears Under 300k",
            "template" => 2,
            "content" => $arrayOfItemUnderPrice
        );

        array_push($productArr, $image, $e, $itemUnderPrice);
		
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