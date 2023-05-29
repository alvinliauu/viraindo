<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/connection/databaseconnect.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/auth/AuthMiddleware.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/function.php';
require '../../vendor/autoload.php';

header('Access-Control-Allow-Origin: https://www.mindli.site');

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->getConnection();
$auth = new Auth($conn, $allHeaders);

$valid =  json_decode(json_encode($auth->isValid()), true);

$datetime = date("Y-m-d h:i:s");
$name = $valid['user']['user_name'];

if($valid["success"] == 1){
    
    $hostname = "QZdlXucJJGtO";
    $username = "W5F0XuIPL3c=";
    $password = "Do43Tb9QJXwK";
    $database = "RskwB7tYeSplTkgsShUAsJ4=";
    $decryption_key = "viraindo jaya";

    $host = decrypt($decryption_key, $hostname);
    $user = decrypt($decryption_key, $username);
    $pass = decrypt($decryption_key, $password);
    $db   = decrypt($decryption_key, $database);

    $konek = mysqli_connect($host, $user, $pass, $db);

// if(isset($_POST['submit'])){
    $err = "";
    $ekstensi = "";
    $success = "";

    $file_name = $_FILES['file']['name']; //untuk mendapatkan nama file yang diupload
    $file_data = $_FILES['file']['tmp_name']; //untuk mendapatkan temporary data
    
    if(empty($file_name)){
        $err .= "Silahkan masukan file yang kamu inginkan.";
    }
    else{
        $ekstensi = pathinfo($file_name)['extension'];
    }

    $ekstensi_allowed = array("xls", "xlsx");
    if(!in_array($ekstensi, $ekstensi_allowed)){
        $err .= "silahkan masukan file tipe xls/xlsx. File $file_name memiliki ekstensi $ekstensi";
    }
    if(empty($err)){
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
    
        $spreadsheet = $reader->load($file_data);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();        
        
        $getSheetName = $spreadsheet->getSheetNames(); 
        
        
        //Jika input excel dengan satu sheet saja            
        if(count($getSheetName) <= 1){
            
            //BUAT DAPETIN VALUE DARI COLOR KUNING DAN PUTIH
            for($i = 1; $i <= count($sheetData); $i++){
                $getColorSheetData = $spreadsheet->getActiveSheet()->getStyle($i)->getFill()->getStartColor()->getARGB();                       
                
                if($getColorSheetData == 'FFFFFFFF'){                        
                    $ArrayOfGetItemsFromSheet[] = $sheetData[$i-1][0];                        
                }
    
                if($getColorSheetData == 'FFFFFF00'){                        
                    $ArrayOfGetSubCategoryFromSheet[] = $sheetData[$i-1][0];                        
                }
            }
            //BUAT DAPETIN VALUE DARI COLOR KUNING DAN PUTIH

            $getCategoryFromSheet = $getSheetName[0];

            $QueryGetCategory = "SELECT category_id, category_name FROM tbl_viraindo_category WHERE category_name = '$getCategoryFromSheet';";
            $RunQueryGetCategory = mysqli_query($konek, $QueryGetCategory);            

            //Jika category namenya ada di database maka tidak ada insert category, dan insert categorynya langsung masuk ke else             
            if($QueryGetCategoryRow = mysqli_fetch_array($RunQueryGetCategory)){
                $GetCategoryId = $QueryGetCategoryRow['category_id'];                

                $ArrayOfGetSubCategory = [];                
                                                
                $QueryGetSubCategory = "SELECT sub_category_name FROM tbl_viraindo_sub_category;";
                $RunQueryGetSubCategory = mysqli_query($konek, $QueryGetSubCategory);

                while ($QueryGetSubCategoryRows = mysqli_fetch_array($RunQueryGetSubCategory, MYSQLI_ASSOC)) {
                    $ArrayOfGetSubCategory[] = $QueryGetSubCategoryRows['sub_category_name'];
                }
                
                //Untuk ngecek apakah ada perbedaan antara array subcategory di sheet dengan di database
                if($differentOfArraySubCategory = array_diff($ArrayOfGetSubCategoryFromSheet, $ArrayOfGetSubCategory)){
                    
                    //Jika ada perbedaan array maka akan melakukan insert subcategory dari sheet ke database
                    foreach ($differentOfArraySubCategory as $key => $value) {
                        $getDifferentSubCategory = $differentOfArraySubCategory[$key];                    

                        $QueryInsertNewDiffSubCategory = "INSERT INTO tbl_viraindo_sub_category(category_id, sub_category_name, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy) VALUES ('$GetCategoryId', '$getDifferentSubCategory', '1', '$datetime', '$name', '1', '$datetime', '$name');";
                        mysqli_query($konek, $QueryInsertNewDiffSubCategory);
                    }         
                    
                    //========================================MASUKIN TESTINGNYA DISINI======================================
                    //BUAT GET ITEM DARI DATABASE
                    $QueryGetItemName = "SELECT DISTINCT TVI.item_name, TVI.item_new_price FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
                    ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
                    ON TVC.category_id = TVSC.category_id WHERE TVC.category_id = '$GetCategoryId';";

                    $RunQueryGetItemName = mysqli_query($konek, $QueryGetItemName);

                    $ArrayOfGetItemName = [];
                    $ArrayOfGetItemPrice = [];
                    $getColorSheetData = [];
                    
                    while($QueryGetItemNameRows = mysqli_fetch_array($RunQueryGetItemName, MYSQLI_ASSOC)){
                        $ArrayOfGetItemName[] = $QueryGetItemNameRows['item_name'];
                        $ArrayOfGetItemPrice[] = $QueryGetItemNameRows['item_new_price'];
                    }
                    
                    $ArrayOfGetSubCategoryFromSheet = [];
                    for($getColorForExcel = 1; $getColorForExcel <= count($sheetData); $getColorForExcel++){
                        $getColorSheetDataForItems = $spreadsheet->getActiveSheet()->getStyle($getColorForExcel)->getFill()->getStartColor()->getARGB();
                        
                        if($getColorSheetDataForItems == 'FFFFFF00'){
                            //jika kolom kuning maka print value dari kolom kuning tersebut
                            
                            $getColorSheetYellowData = $sheetData[$getColorForExcel-1][0];
                            
                            $QueryGetSubCategoryId = "SELECT * FROM tbl_viraindo_sub_category WHERE sub_category_name = '$getColorSheetYellowData';";
                            $RunQueryGetSubCategoryId = mysqli_query($konek, $QueryGetSubCategoryId);                                                            
                        } 
                        
                        
                        if($getColorSheetDataForItems == 'FFFFFFFF'){
                            while ($QueryGetSubCategoryIdRows = mysqli_fetch_array($RunQueryGetSubCategoryId, MYSQLI_ASSOC)) {
                                $ArrayOfGetSubCategoryId = $QueryGetSubCategoryIdRows['sub_category_id'];
                            }
                            
                            $getColorSheetWhiteData = $sheetData[$getColorForExcel-1];
                            $getColorSheetWhiteDataWithArr[] = $sheetData[$getColorForExcel-1];
                            
                            $ArrayOfGetItemNameFromSheet[] = trim(preg_replace('/\s+/', ' ', $getColorSheetWhiteData[0]));
                            $ArrayOfGetItemPriceFromSheet[] = $getColorSheetWhiteData[1];
                            
                            $ArrayOfGetItemNameString = trim(preg_replace('/\s+/', ' ', $getColorSheetWhiteData[0]));
                            $ArrayOfGetItemPriceString = $getColorSheetWhiteData[1];   

                            $obj = new stdClass();
                            
                            $obj->sub_category_id = $ArrayOfGetSubCategoryId;
                            $obj->item_name = $ArrayOfGetItemNameString;
                            $obj->item_picture = "https://images.tokopedia.net/img/cache/215-square/GAnVPX/2021/9/14/4f680add-d304-41a1-af8b-e77129a4cf61.jpg";
                            $obj->item_new_price = $ArrayOfGetItemPriceString;
                            $obj->item_old_price = $ArrayOfGetItemPriceString;
                            $obj->isActive = 1;
                            array_push($ArrayOfGetSubCategoryFromSheet, $obj);
                        }
                                                
                    }               
                    $ArrayOfGetSubCatFromSheet = json_decode(json_encode($ArrayOfGetSubCategoryFromSheet), true);                      
                    
                    if($GetDifferentOfItem = array_diff($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName)){                    
                    
                        for($diffItem = 0; $diffItem <= count($GetDifferentOfItem) + 1; $diffItem++){

                            $sub_category_id = $ArrayOfGetSubCatFromSheet[$diffItem]['sub_category_id'];
                            $item_name       = $ArrayOfGetSubCatFromSheet[$diffItem]['item_name'];
                            $item_picture    = $ArrayOfGetSubCatFromSheet[$diffItem]['item_picture'];
                            $item_new_price  = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$diffItem]['item_new_price']);
                            $item_old_price  = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$diffItem]['item_old_price']);
                            $isActive        = $ArrayOfGetSubCatFromSheet[$diffItem]['isActive'];                

                            $QueryInsertItem = "INSERT INTO tbl_viraindo_item (sub_category_id, item_name, item_picture, item_new_price, item_old_price, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy)
                            VALUES ('$sub_category_id', '$item_name', '$item_picture', '$item_new_price', '$item_old_price', '$isActive', '$datetime', '$name', '1', '$datetime', '$name');";
                            mysqli_query($konek, $QueryInsertItem);
                        }                                                                                            

                        if($GetSameOfItem = array_intersect($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName)){                                                                                                                                                          

                            $ArrayOfSubCatFromSheet = [];
                            foreach ($ArrayOfGetSubCatFromSheet as $key => $val) {
                                
                                $ArrayOfSubCatFromSheet[] = $val['item_name'];

                                $KeyOfSubCatFromSheet = array_intersect($ArrayOfSubCatFromSheet, $GetSameOfItem);
                                $GetTheKeyOfSubCatFromSheet = array_keys($KeyOfSubCatFromSheet);
                                
                            }
                            
                            $updateItemNewPrice = [];

                            foreach ($GetTheKeyOfSubCatFromSheet as $key => $value) {
                                                                    
                                $updateItemNewPrice = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$value]['item_new_price']);  
                                $SameItem = $ArrayOfGetSubCatFromSheet[$value]['item_name'];
                                
                                $QueryForGettingOldPrice = "SELECT item_new_price FROM tbl_viraindo_item WHERE item_name = '$SameItem';";
                                $RunQueryGettingOldPrice = mysqli_query($konek, $QueryForGettingOldPrice);
                                
                                while ($QueryGetOldPrice = mysqli_fetch_array($RunQueryGettingOldPrice, MYSQLI_ASSOC)) {
                                    $ArrayOfGetOldPrice = $QueryGetOldPrice['item_new_price'];
                                }                                                                        

                                $QueryUpdateItem = "UPDATE tbl_viraindo_item SET item_new_price = '$updateItemNewPrice', item_old_price = '$ArrayOfGetOldPrice' WHERE item_name = '$SameItem';";
                                mysqli_query($konek, $QueryUpdateItem);
                            }                 
                        }
                                                                              
                    }
                    else{
                        // buat update harga aja                                              
                        if($GetSameOfItem = array_intersect($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName)){                                                                                                                                                          

                            $ArrayOfSubCatFromSheet = [];
                            foreach ($ArrayOfGetSubCatFromSheet as $key => $val) {
                                
                                $ArrayOfSubCatFromSheet[] = $val['item_name'];

                                $KeyOfSubCatFromSheet = array_intersect($ArrayOfSubCatFromSheet, $GetSameOfItem);
                                $GetTheKeyOfSubCatFromSheet = array_keys($KeyOfSubCatFromSheet);
                                
                            }
                            
                            $updateItemNewPrice = [];

                            foreach ($GetTheKeyOfSubCatFromSheet as $key => $value) {
                                                                    
                                $updateItemNewPrice = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$value]['item_new_price']);  
                                $SameItem = $ArrayOfGetSubCatFromSheet[$value]['item_name'];
                                
                                $QueryForGettingOldPrice = "SELECT item_new_price FROM tbl_viraindo_item WHERE item_name = '$SameItem';";
                                $RunQueryGettingOldPrice = mysqli_query($konek, $QueryForGettingOldPrice);
                                
                                while ($QueryGetOldPrice = mysqli_fetch_array($RunQueryGettingOldPrice, MYSQLI_ASSOC)) {
                                    $ArrayOfGetOldPrice = $QueryGetOldPrice['item_new_price'];
                                }                                                                        

                                $QueryUpdateItem = "UPDATE tbl_viraindo_item SET item_new_price = '$updateItemNewPrice', item_old_price = '$ArrayOfGetOldPrice' WHERE item_name = '$SameItem';";
                                mysqli_query($konek, $QueryUpdateItem);

                            }                            
                        }
                    }          
                    
                }
                else{
                    
                    //BUAT GET ITEM DARI DATABASE
                    $QueryGetItemName = "SELECT DISTINCT TVI.item_name, TVI.item_new_price FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
                    ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
                    ON TVC.category_id = TVSC.category_id WHERE TVC.category_id = '$GetCategoryId';";

                    $RunQueryGetItemName = mysqli_query($konek, $QueryGetItemName);

                    $ArrayOfGetItemName = [];
                    $ArrayOfGetItemPrice = [];
                    $getColorSheetData = [];
                    
                    while($QueryGetItemNameRows = mysqli_fetch_array($RunQueryGetItemName, MYSQLI_ASSOC)){
                        $ArrayOfGetItemName[] = $QueryGetItemNameRows['item_name'];
                        $ArrayOfGetItemPrice[] = $QueryGetItemNameRows['item_new_price'];
                    }
                    
                    $ArrayOfGetSubCategoryFromSheet = [];
                    for($getColorForExcel = 1; $getColorForExcel <= count($sheetData); $getColorForExcel++){
                        $getColorSheetDataForItems = $spreadsheet->getActiveSheet()->getStyle($getColorForExcel)->getFill()->getStartColor()->getARGB();
                        
                        if($getColorSheetDataForItems == 'FFFFFF00'){
                            //jika kolom kuning maka print value dari kolom kuning tersebut
                            
                            $getColorSheetYellowData = $sheetData[$getColorForExcel-1][0];
                            
                            $QueryGetSubCategoryId = "SELECT * FROM tbl_viraindo_sub_category WHERE sub_category_name = '$getColorSheetYellowData';";
                            $RunQueryGetSubCategoryId = mysqli_query($konek, $QueryGetSubCategoryId);                                                            
                        } 
                        
                        
                        if($getColorSheetDataForItems == 'FFFFFFFF'){
                            while ($QueryGetSubCategoryIdRows = mysqli_fetch_array($RunQueryGetSubCategoryId, MYSQLI_ASSOC)) {
                                $ArrayOfGetSubCategoryId = $QueryGetSubCategoryIdRows['sub_category_id'];
                            }
                            
                            $getColorSheetWhiteData = $sheetData[$getColorForExcel-1];
                            $getColorSheetWhiteDataWithArr[] = $sheetData[$getColorForExcel-1];
                            
                            $ArrayOfGetItemNameFromSheet[] = trim(preg_replace('/\s+/', ' ', $getColorSheetWhiteData[0]));
                            $ArrayOfGetItemPriceFromSheet[] = $getColorSheetWhiteData[1];
                            
                            $ArrayOfGetItemNameString = trim(preg_replace('/\s+/', ' ', $getColorSheetWhiteData[0]));
                            $ArrayOfGetItemPriceString = $getColorSheetWhiteData[1];   

                            $obj = new stdClass();
                            
                            $obj->sub_category_id = $ArrayOfGetSubCategoryId;
                            $obj->item_name = $ArrayOfGetItemNameString;
                            $obj->item_picture = "https://images.tokopedia.net/img/cache/215-square/GAnVPX/2021/9/14/4f680add-d304-41a1-af8b-e77129a4cf61.jpg";
                            $obj->item_new_price = $ArrayOfGetItemPriceString;
                            $obj->item_old_price = $ArrayOfGetItemPriceString;
                            $obj->isActive = 1;
                            array_push($ArrayOfGetSubCategoryFromSheet, $obj);
                        }
                                                
                    }               
                    $ArrayOfGetSubCatFromSheet = json_decode(json_encode($ArrayOfGetSubCategoryFromSheet), true);                      
                    
                    if($GetDifferentOfItem = array_diff_ukey($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName, "strcasecmp")){                    
                        
                        foreach ($GetDifferentOfItem as $key => $value) {
                            
                            $sub_category_id = $ArrayOfGetSubCatFromSheet[$key]['sub_category_id'];
                            $item_name       = $ArrayOfGetSubCatFromSheet[$key]['item_name'];
                            $item_picture    = $ArrayOfGetSubCatFromSheet[$key]['item_picture'];
                            $item_new_price  = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$key]['item_new_price']);
                            $item_old_price  = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$key]['item_old_price']);
                            $isActive        = $ArrayOfGetSubCatFromSheet[$key]['isActive'];                                         
                            
                            $QueryInsertItem = "INSERT INTO tbl_viraindo_item (sub_category_id, item_name, item_picture, item_new_price, item_old_price, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy)
                            VALUES ('$sub_category_id', '$item_name', '$item_picture', '$item_new_price', '$item_old_price', '$isActive', '$datetime', '$name', '1', '$datetime', '$name');";
                            mysqli_query($konek, $QueryInsertItem);

                        }                                                                                    

                        if($GetSameOfItem = array_intersect_ukey($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName, "strcasecmp")){                                                                                                                                                          

                            $ArrayOfSubCatFromSheet = [];
                            foreach ($ArrayOfGetSubCatFromSheet as $key => $val) {
                                
                                $ArrayOfSubCatFromSheet[] = $val['item_name'];

                                $KeyOfSubCatFromSheet = array_intersect($ArrayOfSubCatFromSheet, $GetSameOfItem);
                                $GetTheKeyOfSubCatFromSheet = array_keys($KeyOfSubCatFromSheet);
                                
                            }
                            
                            $updateItemNewPrice = [];

                            foreach ($GetTheKeyOfSubCatFromSheet as $key => $value) {
                                                                    
                                $updateItemNewPrice = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$value]['item_new_price']);  
                                $SameItem = $ArrayOfGetSubCatFromSheet[$value]['item_name'];
                                
                                $QueryForGettingOldPrice = "SELECT item_new_price FROM tbl_viraindo_item WHERE item_name = '$SameItem';";
                                $RunQueryGettingOldPrice = mysqli_query($konek, $QueryForGettingOldPrice);
                                
                                while ($QueryGetOldPrice = mysqli_fetch_array($RunQueryGettingOldPrice, MYSQLI_ASSOC)) {
                                    $ArrayOfGetOldPrice = $QueryGetOldPrice['item_new_price'];
                                }                                                                        

                                $QueryUpdateItem = "UPDATE tbl_viraindo_item SET item_new_price = '$updateItemNewPrice', item_old_price = '$ArrayOfGetOldPrice' WHERE item_name = '$SameItem';";
                                mysqli_query($konek, $QueryUpdateItem);
                            }                 
                        }
                                                                              
                    }
                    else{
                        // buat update harga aja                                              
                        if($GetSameOfItem = array_intersect($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName)){                                                                                                                                                          

                            $ArrayOfSubCatFromSheet = [];
                            foreach ($ArrayOfGetSubCatFromSheet as $key => $val) {
                                
                                $ArrayOfSubCatFromSheet[] = $val['item_name'];

                                $KeyOfSubCatFromSheet = array_intersect($ArrayOfSubCatFromSheet, $GetSameOfItem);
                                $GetTheKeyOfSubCatFromSheet = array_keys($KeyOfSubCatFromSheet);
                                
                            }
                            
                            $updateItemNewPrice = [];

                            foreach ($GetTheKeyOfSubCatFromSheet as $key => $value) {
                                                                    
                                $updateItemNewPrice = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$value]['item_new_price']);  
                                $SameItem = $ArrayOfGetSubCatFromSheet[$value]['item_name'];
                                
                                $QueryForGettingOldPrice = "SELECT item_new_price FROM tbl_viraindo_item WHERE item_name = '$SameItem';";
                                $RunQueryGettingOldPrice = mysqli_query($konek, $QueryForGettingOldPrice);
                                
                                while ($QueryGetOldPrice = mysqli_fetch_array($RunQueryGettingOldPrice, MYSQLI_ASSOC)) {
                                    $ArrayOfGetOldPrice = $QueryGetOldPrice['item_new_price'];
                                }                                                                        

                                $QueryUpdateItem = "UPDATE tbl_viraindo_item SET item_new_price = '$updateItemNewPrice', item_old_price = '$ArrayOfGetOldPrice' WHERE item_name = '$SameItem';";
                                mysqli_query($konek, $QueryUpdateItem);

                            }                            
                        }
                    } 
                }
            }
            else{

                $QueryInsertNewCategory = "INSERT INTO tbl_viraindo_category(category_name, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy) VALUES ('$getCategoryFromSheet', '1', '$datetime', '$name', '1', '$datetime', '$name');";
                mysqli_query($konek, $QueryInsertNewCategory);

                $getCategoryFromSheet = $getSheetName[0];

                $QueryGetCategory = "SELECT category_id, category_name FROM tbl_viraindo_category WHERE category_name = '$getCategoryFromSheet';";
                $RunQueryGetCategory = mysqli_query($konek, $QueryGetCategory);

                //Jika category namenya ada di database maka tidak ada insert category, dan insert categorynya langsung masuk ke else             
                if($QueryGetCategoryRow = mysqli_fetch_array($RunQueryGetCategory)){
                    $GetCategoryId = $QueryGetCategoryRow['category_id'];                

                    $ArrayOfGetSubCategory = [];                
                                                    
                    $QueryGetSubCategory = "SELECT sub_category_name FROM tbl_viraindo_sub_category;";
                    $RunQueryGetSubCategory = mysqli_query($konek, $QueryGetSubCategory);

                    while ($QueryGetSubCategoryRows = mysqli_fetch_array($RunQueryGetSubCategory, MYSQLI_ASSOC)) {
                        $ArrayOfGetSubCategory[] = $QueryGetSubCategoryRows['sub_category_name'];
                    }

                    //Untuk ngecek apakah ada perbedaan antara array subcategory di sheet dengan di database
                    if($differentOfArraySubCategory = array_diff($ArrayOfGetSubCategoryFromSheet, $ArrayOfGetSubCategory)){

                        //Jika ada perbedaan array maka akan melakukan insert subcategory dari sheet ke database
                        foreach ($differentOfArraySubCategory as $key => $value) {
                            $getDifferentSubCategory = $differentOfArraySubCategory[$key];                    

                            $QueryInsertNewDiffSubCategory = "INSERT INTO tbl_viraindo_sub_category(category_id, sub_category_name, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy) VALUES ('$GetCategoryId', '$getDifferentSubCategory', '1', '$datetime', '$name', '1', '$datetime', '$name');";
                            mysqli_query($konek, $QueryInsertNewDiffSubCategory);
                        }         
                        
                        //========================================MASUKIN TESTINGNYA DISINI======================================
                        //BUAT GET ITEM DARI DATABASE
                        $QueryGetItemName = "SELECT DISTINCT TVI.item_name, TVI.item_new_price FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
                        ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
                        ON TVC.category_id = TVSC.category_id WHERE TVC.category_id = '$GetCategoryId';";

                        $RunQueryGetItemName = mysqli_query($konek, $QueryGetItemName);

                        $ArrayOfGetItemName = [];
                        $ArrayOfGetItemPrice = [];
                        $getColorSheetData = [];
                        
                        while($QueryGetItemNameRows = mysqli_fetch_array($RunQueryGetItemName, MYSQLI_ASSOC)){
                            $ArrayOfGetItemName[] = $QueryGetItemNameRows['item_name'];
                            $ArrayOfGetItemPrice[] = $QueryGetItemNameRows['item_new_price'];
                        }
                        
                        $ArrayOfGetSubCategoryFromSheet = [];
                        for($getColorForExcel = 1; $getColorForExcel <= count($sheetData); $getColorForExcel++){
                            $getColorSheetDataForItems = $spreadsheet->getActiveSheet()->getStyle($getColorForExcel)->getFill()->getStartColor()->getARGB();
                            
                            if($getColorSheetDataForItems == 'FFFFFF00'){
                                //jika kolom kuning maka print value dari kolom kuning tersebut
                                
                                $getColorSheetYellowData = $sheetData[$getColorForExcel-1][0];
                                
                                $QueryGetSubCategoryId = "SELECT * FROM tbl_viraindo_sub_category WHERE sub_category_name = '$getColorSheetYellowData';";
                                $RunQueryGetSubCategoryId = mysqli_query($konek, $QueryGetSubCategoryId);                                                            
                            } 
                            
                            
                            if($getColorSheetDataForItems == 'FFFFFFFF'){
                                while ($QueryGetSubCategoryIdRows = mysqli_fetch_array($RunQueryGetSubCategoryId, MYSQLI_ASSOC)) {
                                    $ArrayOfGetSubCategoryId = $QueryGetSubCategoryIdRows['sub_category_id'];
                                }
                                
                                $getColorSheetWhiteData = $sheetData[$getColorForExcel-1];
                                $getColorSheetWhiteDataWithArr[] = $sheetData[$getColorForExcel-1];
                                
                                $ArrayOfGetItemNameFromSheet[] = trim(preg_replace('/\s+/', ' ', $getColorSheetWhiteData[0]));
                                $ArrayOfGetItemPriceFromSheet[] = $getColorSheetWhiteData[1];
                                
                                $ArrayOfGetItemNameString = trim(preg_replace('/\s+/', ' ', $getColorSheetWhiteData[0]));
                                $ArrayOfGetItemPriceString = $getColorSheetWhiteData[1];   

                                $obj = new stdClass();
                                
                                $obj->sub_category_id = $ArrayOfGetSubCategoryId;
                                $obj->item_name = $ArrayOfGetItemNameString;
                                $obj->item_picture = "https://images.tokopedia.net/img/cache/215-square/GAnVPX/2021/9/14/4f680add-d304-41a1-af8b-e77129a4cf61.jpg";
                                $obj->item_new_price = $ArrayOfGetItemPriceString;
                                $obj->item_old_price = $ArrayOfGetItemPriceString;
                                $obj->isActive = 1;
                                array_push($ArrayOfGetSubCategoryFromSheet, $obj);
                            }
                                                    
                        }               
                        $ArrayOfGetSubCatFromSheet = json_decode(json_encode($ArrayOfGetSubCategoryFromSheet), true);                      
                        
                        if($GetDifferentOfItem = array_diff($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName)){                    
                        
                            for($diffItem = 0; $diffItem <= count($GetDifferentOfItem) + 1; $diffItem++){

                                $sub_category_id = $ArrayOfGetSubCatFromSheet[$diffItem]['sub_category_id'];
                                $item_name       = $ArrayOfGetSubCatFromSheet[$diffItem]['item_name'];
                                $item_picture    = $ArrayOfGetSubCatFromSheet[$diffItem]['item_picture'];
                                $item_new_price  = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$diffItem]['item_new_price']);
                                $item_old_price  = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$diffItem]['item_old_price']);
                                $isActive        = $ArrayOfGetSubCatFromSheet[$diffItem]['isActive'];                 

                                $QueryInsertItem = "INSERT INTO tbl_viraindo_item (sub_category_id, item_name, item_picture, item_new_price, item_old_price, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy)
                                VALUES ('$sub_category_id', '$item_name', '$item_picture', '$item_new_price', '$item_old_price', '$isActive', '$datetime', '$name', '1', '$datetime', '$name');";
                                mysqli_query($konek, $QueryInsertItem);
                            }                                                                                            

                            if($GetSameOfItem = array_intersect($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName)){                                                                                                                                                          

                                $ArrayOfSubCatFromSheet = [];
                                foreach ($ArrayOfGetSubCatFromSheet as $key => $val) {
                                    
                                    $ArrayOfSubCatFromSheet[] = $val['item_name'];

                                    $KeyOfSubCatFromSheet = array_intersect($ArrayOfSubCatFromSheet, $GetSameOfItem);
                                    $GetTheKeyOfSubCatFromSheet = array_keys($KeyOfSubCatFromSheet);
                                    
                                }
                                
                                $updateItemNewPrice = [];

                                foreach ($GetTheKeyOfSubCatFromSheet as $key => $value) {
                                                                        
                                    $updateItemNewPrice = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$value]['item_new_price']);  
                                    $SameItem = $ArrayOfGetSubCatFromSheet[$value]['item_name'];
                                    
                                    $QueryForGettingOldPrice = "SELECT item_new_price FROM tbl_viraindo_item WHERE item_name = '$SameItem';";
                                    $RunQueryGettingOldPrice = mysqli_query($konek, $QueryForGettingOldPrice);
                                    
                                    while ($QueryGetOldPrice = mysqli_fetch_array($RunQueryGettingOldPrice, MYSQLI_ASSOC)) {
                                        $ArrayOfGetOldPrice = $QueryGetOldPrice['item_new_price'];
                                    }                                                                        

                                    $QueryUpdateItem = "UPDATE tbl_viraindo_item SET item_new_price = '$updateItemNewPrice', item_old_price = '$ArrayOfGetOldPrice' WHERE item_name = '$SameItem';";
                                    mysqli_query($konek, $QueryUpdateItem);
                                }                 
                            }
                                                                                
                        }
                        else{
                            // buat update harga aja                                              
                            if($GetSameOfItem = array_intersect($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName)){                                                                                                                                                          

                                $ArrayOfSubCatFromSheet = [];
                                foreach ($ArrayOfGetSubCatFromSheet as $key => $val) {
                                    
                                    $ArrayOfSubCatFromSheet[] = $val['item_name'];

                                    $KeyOfSubCatFromSheet = array_intersect($ArrayOfSubCatFromSheet, $GetSameOfItem);
                                    $GetTheKeyOfSubCatFromSheet = array_keys($KeyOfSubCatFromSheet);
                                    
                                }
                                
                                $updateItemNewPrice = [];

                                foreach ($GetTheKeyOfSubCatFromSheet as $key => $value) {
                                                                        
                                    $updateItemNewPrice = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$value]['item_new_price']);  
                                    $SameItem = $ArrayOfGetSubCatFromSheet[$value]['item_name'];
                                    
                                    $QueryForGettingOldPrice = "SELECT item_new_price FROM tbl_viraindo_item WHERE item_name = '$SameItem';";
                                    $RunQueryGettingOldPrice = mysqli_query($konek, $QueryForGettingOldPrice);
                                    
                                    while ($QueryGetOldPrice = mysqli_fetch_array($RunQueryGettingOldPrice, MYSQLI_ASSOC)) {
                                        $ArrayOfGetOldPrice = $QueryGetOldPrice['item_new_price'];
                                    }                                                                        

                                    $QueryUpdateItem = "UPDATE tbl_viraindo_item SET item_new_price = '$updateItemNewPrice', item_old_price = '$ArrayOfGetOldPrice' WHERE item_name = '$SameItem';";
                                    mysqli_query($konek, $QueryUpdateItem);

                                }                            
                            }
                        }          
                        
                    }
                    else{
                        
                        //BUAT GET ITEM DARI DATABASE
                        $QueryGetItemName = "SELECT DISTINCT TVI.item_name, TVI.item_new_price FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
                        ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
                        ON TVC.category_id = TVSC.category_id WHERE TVC.category_id = '$GetCategoryId';";

                        $RunQueryGetItemName = mysqli_query($konek, $QueryGetItemName);

                        $ArrayOfGetItemName = [];
                        $ArrayOfGetItemPrice = [];
                        $getColorSheetData = [];
                        
                        while($QueryGetItemNameRows = mysqli_fetch_array($RunQueryGetItemName, MYSQLI_ASSOC)){
                            $ArrayOfGetItemName[] = $QueryGetItemNameRows['item_name'];
                            $ArrayOfGetItemPrice[] = $QueryGetItemNameRows['item_new_price'];
                        }
                        
                        $ArrayOfGetSubCategoryFromSheet = [];
                        for($getColorForExcel = 1; $getColorForExcel <= count($sheetData); $getColorForExcel++){
                            $getColorSheetDataForItems = $spreadsheet->getActiveSheet()->getStyle($getColorForExcel)->getFill()->getStartColor()->getARGB();
                            
                            if($getColorSheetDataForItems == 'FFFFFF00'){
                                //jika kolom kuning maka print value dari kolom kuning tersebut
                                
                                $getColorSheetYellowData = $sheetData[$getColorForExcel-1][0];
                                
                                $QueryGetSubCategoryId = "SELECT * FROM tbl_viraindo_sub_category WHERE sub_category_name = '$getColorSheetYellowData';";
                                $RunQueryGetSubCategoryId = mysqli_query($konek, $QueryGetSubCategoryId);                                                            
                            } 
                            
                            
                            if($getColorSheetDataForItems == 'FFFFFFFF'){
                                while ($QueryGetSubCategoryIdRows = mysqli_fetch_array($RunQueryGetSubCategoryId, MYSQLI_ASSOC)) {
                                    $ArrayOfGetSubCategoryId = $QueryGetSubCategoryIdRows['sub_category_id'];
                                }
                                
                                $getColorSheetWhiteData = $sheetData[$getColorForExcel-1];
                                $getColorSheetWhiteDataWithArr[] = $sheetData[$getColorForExcel-1];
                                
                                $ArrayOfGetItemNameFromSheet[] = trim(preg_replace('/\s+/', ' ', $getColorSheetWhiteData[0]));
                                $ArrayOfGetItemPriceFromSheet[] = $getColorSheetWhiteData[1];
                                
                                $ArrayOfGetItemNameString = trim(preg_replace('/\s+/', ' ', $getColorSheetWhiteData[0]));
                                $ArrayOfGetItemPriceString = $getColorSheetWhiteData[1];   

                                $obj = new stdClass();
                                
                                $obj->sub_category_id = $ArrayOfGetSubCategoryId;
                                $obj->item_name = $ArrayOfGetItemNameString;
                                $obj->item_picture = "https://images.tokopedia.net/img/cache/215-square/GAnVPX/2021/9/14/4f680add-d304-41a1-af8b-e77129a4cf61.jpg";
                                $obj->item_new_price = $ArrayOfGetItemPriceString;
                                $obj->item_old_price = $ArrayOfGetItemPriceString;
                                $obj->isActive = 1;
                                array_push($ArrayOfGetSubCategoryFromSheet, $obj);
                            }
                                                    
                        }               
                        $ArrayOfGetSubCatFromSheet = json_decode(json_encode($ArrayOfGetSubCategoryFromSheet), true);                      
                        
                        if($GetDifferentOfItem = array_diff($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName)){                    
                        
                            for($diffItem = 0; $diffItem <= count($GetDifferentOfItem) + 1; $diffItem++){

                                $sub_category_id = $ArrayOfGetSubCatFromSheet[$diffItem]['sub_category_id'];
                                $item_name       = $ArrayOfGetSubCatFromSheet[$diffItem]['item_name'];
                                $item_picture    = $ArrayOfGetSubCatFromSheet[$diffItem]['item_picture'];
                                $item_new_price  = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$diffItem]['item_new_price']);
                                $item_old_price  = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$diffItem]['item_old_price']);
                                $isActive        = $ArrayOfGetSubCatFromSheet[$diffItem]['isActive'];      

                                $QueryInsertItem = "INSERT INTO tbl_viraindo_item (sub_category_id, item_name, item_picture, item_new_price, item_old_price, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy)
                                VALUES ('$sub_category_id', '$item_name', '$item_picture', '$item_new_price', '$item_old_price', '$isActive', '$datetime', '$name', '1', '$datetime', '$name');";
                                mysqli_query($konek, $QueryInsertItem);
                            }                                                                                            

                            if($GetSameOfItem = array_intersect($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName)){                                                                                                                                                          

                                $ArrayOfSubCatFromSheet = [];
                                foreach ($ArrayOfGetSubCatFromSheet as $key => $val) {
                                    
                                    $ArrayOfSubCatFromSheet[] = $val['item_name'];

                                    $KeyOfSubCatFromSheet = array_intersect($ArrayOfSubCatFromSheet, $GetSameOfItem);
                                    $GetTheKeyOfSubCatFromSheet = array_keys($KeyOfSubCatFromSheet);
                                    
                                }
                                
                                $updateItemNewPrice = [];

                                foreach ($GetTheKeyOfSubCatFromSheet as $key => $value) {
                                                                        
                                    $updateItemNewPrice = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$value]['item_new_price']);  
                                    $SameItem = $ArrayOfGetSubCatFromSheet[$value]['item_name'];
                                    
                                    $QueryForGettingOldPrice = "SELECT item_new_price FROM tbl_viraindo_item WHERE item_name = '$SameItem';";
                                    $RunQueryGettingOldPrice = mysqli_query($konek, $QueryForGettingOldPrice);
                                    
                                    while ($QueryGetOldPrice = mysqli_fetch_array($RunQueryGettingOldPrice, MYSQLI_ASSOC)) {
                                        $ArrayOfGetOldPrice = $QueryGetOldPrice['item_new_price'];
                                    }                                                                        

                                    $QueryUpdateItem = "UPDATE tbl_viraindo_item SET item_new_price = '$updateItemNewPrice', item_old_price = '$ArrayOfGetOldPrice' WHERE item_name = '$SameItem';";
                                    mysqli_query($konek, $QueryUpdateItem);
                                }                 
                            }
                                                                                
                        }
                        else{
                            // buat update harga aja                                              
                            if($GetSameOfItem = array_intersect($ArrayOfGetItemNameFromSheet, $ArrayOfGetItemName)){                                                                                                                                                          

                                $ArrayOfSubCatFromSheet = [];
                                foreach ($ArrayOfGetSubCatFromSheet as $key => $val) {
                                    
                                    $ArrayOfSubCatFromSheet[] = $val['item_name'];

                                    $KeyOfSubCatFromSheet = array_intersect($ArrayOfSubCatFromSheet, $GetSameOfItem);
                                    $GetTheKeyOfSubCatFromSheet = array_keys($KeyOfSubCatFromSheet);
                                    
                                }
                                
                                $updateItemNewPrice = [];

                                foreach ($GetTheKeyOfSubCatFromSheet as $key => $value) {
                                                                        
                                    $updateItemNewPrice = str_replace(",", "", $ArrayOfGetSubCatFromSheet[$value]['item_new_price']);  
                                    $SameItem = $ArrayOfGetSubCatFromSheet[$value]['item_name'];
                                    
                                    $QueryForGettingOldPrice = "SELECT item_new_price FROM tbl_viraindo_item WHERE item_name = '$SameItem';";
                                    $RunQueryGettingOldPrice = mysqli_query($konek, $QueryForGettingOldPrice);
                                    
                                    while ($QueryGetOldPrice = mysqli_fetch_array($RunQueryGettingOldPrice, MYSQLI_ASSOC)) {
                                        $ArrayOfGetOldPrice = $QueryGetOldPrice['item_new_price'];
                                    }                                                                        

                                    $QueryUpdateItem = "UPDATE tbl_viraindo_item SET item_new_price = '$updateItemNewPrice', item_old_price = '$ArrayOfGetOldPrice' WHERE item_name = '$SameItem';";
                                    mysqli_query($konek, $QueryUpdateItem);

                                }                            
                            }
                        } 
                    }
                }
            }
            $success = "Data berhasil diinput";
        }



        else{
            //Kalau input excel lebih dari satu sheet
            $ArrayOfGetCategory = [];
            $QueryGetCategory = "SELECT category_name FROM tbl_viraindo_category;";
            $RunQueryGetCategory = mysqli_query($konek, $QueryGetCategory);

            //Buat convert ke array yang rapi
            while ($QueryGetCategoryRows = mysqli_fetch_array($RunQueryGetCategory, MYSQLI_ASSOC)) {

                $ArrayOfGetCategory[] = $QueryGetCategoryRows['category_name'];
                
            }

            //Buat dapetin different array dari category dan di insert
            if($differentOfArray = array_diff($getSheetName, $ArrayOfGetCategory)){

                foreach ($differentOfArray as $key => $value) {
                    
                    $getDifferentCategory = $differentOfArray[$key];

                    $QueryInsertNewDiffCategory = "INSERT INTO tbl_viraindo_category(category_name, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy) VALUES ('$getDifferentCategory', '1', $datetime, $name, '1', $datetime, $name);";
                    mysqli_query($konek, $QueryInsertNewDiffCategory);
                
                }
            }
            else{
                echo "false";
            }
        }
        
    }

    $TheArray = [];

    if($err){
        
        $error = new stdClass();
        $error->code = http_response_code();
        $error->message = "The parameter is not valid";

        array_push($TheArray, $error);

        // throw new Exception("Error Processing Request", 1);        
    }

	else if($success){
        
        $error = new stdClass();
        $error->code = http_response_code();
        $error->message = "The parameter is valid";

        array_push($TheArray, $error);

        // throw new Exception("Error Processing Request", 1);        
    }
	print_r(json_encode($TheArray));
} else {
    $ErrArray = [];
    $error = new stdClass();
    $error->code = http_response_code();
    $error->message = "The token is not valid";

    array_push($ErrArray, $error);

    print_r(json_encode($ErrArray));
}


// }

?>