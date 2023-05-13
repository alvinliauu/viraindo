<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../../connection/databaseconnect.php';
    include_once '../../../controller/select/getViraIndoHome.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new getViraIndoCategory($db);
    $motherboard = $items->getViraIndoMotherboard();
    $processor = $items->getViraIndoProcessor();
    $ssd = $items->getViraIndoSSD();
    $hdd = $items->getViraIndoHDD();
    $ram = $items->getViraIndoRam();
    $vga = $items->getViraIndoVgaCard();
    $mouse = $items->getViraIndoMouse();
    $keyboard = $items->getViraIndoKeyboard();

    if($motherboard > 0 || $processor > 0 || $ssd > 0 || $hdd > 0 || $ram > 0 || $vga > 0 || $mouse > 0 || $keyboard > 0){
        
        $productArr = array();
        $arrmotherboard = [];
        $arrprocessor = [];
        $arrssd = [];
        $arrhdd = [];
        $arrram = [];
        $arrvga = [];
        $arrmouse = [];
        $arrkeyboard = [];
		
        //Motherboard
        while ($rowOfMotherboard = $motherboard->fetch(PDO::FETCH_ASSOC)){
            extract($rowOfMotherboard);

            $listOfMotherboard = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name
            );

            array_push($arrmotherboard, $listOfMotherboard);  
        }
        $objOfMotherboard = array(
            "name" => "Motherboard",
            "image" => array(
                "url" => "https://cdn-icons-png.flaticon.com/512/5921/5921800.png",
                "alt" => "motherboard"
            ),
            "category" => $arrmotherboard
        );

        //Processor
        while ($rowOfProcessor = $processor->fetch(PDO::FETCH_ASSOC)){
            extract($rowOfProcessor);

            $listOfProcessor = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name
            );

            array_push($arrprocessor, $listOfProcessor);   
        }
        $objOfProcessor = array(
            "name" => "Processor",
            "image" => array(
                "url" => "https://cdn-icons-png.flaticon.com/512/1582/1582451.png",
                "alt" => "processor"
            ),
            "category" => $arrprocessor
        );

        //SSD
        while ($rowOfSsd = $ssd->fetch(PDO::FETCH_ASSOC)){
            extract($rowOfSsd);

            $listOfSsd = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name
            );

            array_push($arrssd, $listOfSsd);  
        }
        $objOfSsd = array(
            "name" => "SSD",
            "image" => array(
                "url" => "https://cdn-icons-png.flaticon.com/512/2333/2333323.png",
                "alt" => "ssd"
            ),
            "category" => $arrssd
        );

        //HDD
        while ($rowOfHdd = $hdd->fetch(PDO::FETCH_ASSOC)){
            extract($rowOfHdd);

            $listOfHdd = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name
            );

            array_push($arrhdd, $listOfHdd);    
        }
        $objOfHdd = array(
            "name" => "HDD",
            "image" => array(
                "url" => "https://cdn-icons-png.flaticon.com/512/287/287390.png",
                "alt" => "hdd"
            ),
            "category" => $arrhdd
        );

        //RAM
        while ($rowOfRam = $ram->fetch(PDO::FETCH_ASSOC)){
            extract($rowOfRam);

            $listOfRam = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name
            );

            array_push($arrram, $listOfRam);       
        }
        $objOfRam = array(
            "name" => "RAM",
            "image" => array(
                "url" => "https://cdn-icons-png.flaticon.com/512/3786/3786576.png",
                "alt" => "ram"
            ),
            "category" => $arrram
        );

        //VGA
        while ($rowOfVga = $vga->fetch(PDO::FETCH_ASSOC)){
            extract($rowOfVga);

            $listOfVga = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name
            );

            array_push($arrram, $listOfVga);     
        }
        $objOfVga = array(
            "name" => "VGA",
            "image" => array(
                "url" => "https://cdn-icons-png.flaticon.com/512/1132/1132921.png",
                "alt" => "vga"
            ),
            "category" => $arrvga
        );

        //Mouse
        while ($rowOfMouse = $mouse->fetch(PDO::FETCH_ASSOC)){
            extract($rowOfMouse);

            $listOfMouse = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name
            );

            array_push($arrmouse, $listOfMouse);     
        }
        $objOfMouse = array(
            "name" => "Mouse",
            "image" => array(
                "url" => "https://cdn-icons-png.flaticon.com/512/1787/1787045.png",
                "alt" => "mouse"
            ),
            "category" => $arrmouse
        );

        //Keyboard
        while ($rowOfKeyboard = $keyboard->fetch(PDO::FETCH_ASSOC)){
            extract($rowOfKeyboard);

            $listOfKeyboard = array(
                "id" => $sub_category_id,
                "name" => $sub_category_name
            );

            array_push($arrkeyboard, $listOfKeyboard);     
        }
        $objOfKeyboard = array(
            "name" => "Keyboard",
            "image" => array(
                "url" => "https://cdn-icons-png.flaticon.com/512/4154/4154727.png",
                "alt" => "keyboard"
            ),
            "category" => $arrkeyboard
        );

        array_push($productArr, $objOfMotherboard, $objOfProcessor, $objOfSsd, $objOfHdd, $objOfRam, $objOfVga, $objOfMouse, $objOfKeyboard);
		
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