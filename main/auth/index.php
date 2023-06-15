<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/connection/databaseconnect.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/function.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/main/auth/AuthMiddleware.php';
require '../../vendor/autoload.php';

header('Access-Control-Allow-Origin: https://www.mindli.site');

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->getConnection();
$auth = new Auth($conn, $allHeaders);

$valid =  json_decode(json_encode($auth->isValid()), true);

$datetime = date("Y-m-d h:i:s");
$name = $valid['user']['user_name'];

$imagebase64 = "data:image/jpeg;base64,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hR1bLYC0AmMhAAAhlDJIJVNRDeqUZaVT6Zm/nznhwglbtm799a9n3HvvfVIKrc028lIKyqhSsjnLuPdt9pA9gxY2EQiRzWYpowzIoEHH3X3XXUOOP/7dFe/ecsst77/3PiEklUzteaMe5IApRwubk4K7czGhEOlkynHsTCbTs2evmprZPXv2mjdv3l2///2WrVt9389kMg0N2w293RUkcl/XYiUVUEwl7pny6hcSQhilSilCqAjDLlVVfhhEN+5835dSnn32iHlz5/bt2/f222//1a+uraurU0pSQuobtlNKPd8LRajt3nC+qQZ1OpWWUqZSyb1UyBRSOI6jlBLYd2xDeVkoROj4nghDzlgyldpSvy1KUzPGlVKTJl1y//33244zYsTIBx98MBr5ep5HCOnZ48hR54ySAEkrKcKwlW25fI5xpmv6oYcc2t5bE0IYY0KIvdTEKVvKy0LOtWgnRM/zsvlcVabC8zzTTFRVVk76/vfvvuuu+//wh0sumbR27ZpcIa+UCsJA1/Qjunf/3R13LHrsscsvu0wqpWla8U5JhBCCEDr63NGZTKb9t+aapoVhWF9f//Wf6EFGefULhQh9ERBCuKYZlObyOcZ40rImTpx488033zZjxvxHHsnlc4EQUYmPIB8ceuiht06ffs7IkRVVlbfeepuS6uEF8ykA57v/gA3d8H3/B5f9YO/vTggJw7CxsfHrPcmDkPKykBCqc5awEg07dxqablnJTCbz29tvP/LII88bN27VypUJyyKEUhChCD3PO2bgMXPnzT3uuMGmlbDz+SN7HnXnnXeOGDnyd7/97efrPo+GzIZh9OvX/5prrhlWXb23yulSASN1679o2FZfOkYhEleMllktV6UkMKZpHAAIob169vzFL36RzWbvf+CBdZ9/DgB+4JumKYW0PffoXr3+cN8fTj/jDNM0gZJofbvv+47j5HK5t99+e+2aNQDQr3//E074drduh1dUVYogoCXbiLbYFkVIx7EXL17ykx//WMjdaUW0EMowFkqlojIgffv2veHGG1aseO+pp56q27SRAiSa916kjJ50wokzZ848/czvNr1SKsIoABiGwTnLZDITLrpIRFMZOCeESCFFKJimtVcbmDC6a+euF194oVRBJKK8LAQAEYYpy+rdq/cvp/3yN7/+zepPVietpGWYtucWXCdlWY7tnHDCCQ8++OCAgQNBgWPbpmkSSpWQhFGghAEPfF+AihbpRQX+GWfREr5k+yW58oX8e++/33bbPaQsLDQMw3HsQEmN0Ewmc/LJJ48YOfKaq6/xPI8zHnXvErrh+B4ADBg48OFHHunTp49pJQLXi0qvQnR5lQoAFAFu6Fq0PzKAkUg07aNHIJFKlhYGkaGgnEX7NXqOu3DhovXr1lVUVLh2UwHP6LhQ9tXVyyJT47pOoCQFMAzjrLPP6tq164033JBKp0vbCCkpgJKqkM9zxjTOXdvZvVf8l7KEcla/dVvo+wDwwQcfPPTQQ8lUSuIVuQ1lUePfl6HJ9W5du/Xs2Wv79u3vvfee5/s7G3dFezZBtA1T00R/4gfBmjVrTjv11C6HHCKFKBZD301TlQWyRzF3bw4AEHp+urJChGEhX7jxhhs++OtflZS2Y3NWFpegjlMWFhq6zhhljFNKP16zGlS09Swr9s+kUlJIxrhS0vG8TRs3rl2z9uyzz+acaVqbfVAIAABttrDtVlDFVkzjAJDP5X917bULHl2QSqbyjg0Apd95mV+LI8oiU1M6GhAl0uy2UAqlVLSCJAyCZCrFGTvmmGPuve/ewUOO91zXdd2Kqsqml0mllAJKoHm7eCJVcbmJ7/vRqEVK6bteXV3d7Fmz5j38cOg1lXBVSjEgu3fAw4FKmcTCltsZ7+F5Qqhh6I7nCimSlhUGYRiGdRs3Pvvsc9nGxkHHHnvIoYcWcjndNECBEGG0oyKlVCkABYzunujPGJNSRlL++c0/T506tba2ljSnG4sfQinZtNM8jpcxFhZ/9gI/ZVkAkLftTCpt2wVDNwquk06mBg4YcNWUKaNHj66qrNR1XdN1IETB7mXzURmGqMyXpmmO4/ztb3+bO3fum6+/Xl9fL4VknJfGQqJKFjtjCQe0sPhzcdUIZTQq3hrdjmOcu66ja3r/AQNOPeWU6uHDTz/9tKqqLqV7iFJKXdfN5XKu6y5btmz58uXvv//+ti1bwzAgQCoqKnY07kpwvfhGaGErysLCA6HUVCmFYRhWKmUYxoCBAzljmmlwzj3H3bJ586bNmzzPy+XyxfYUBx4dAy3sKEUdQyWUUpQyRikwyhhzbTvaH5TxFikYtLCDYOKqoyilTNMMwkB6gQClEeL7YXR9pwCMMc54tDYP7xTvL2UxRv6qEEIopYBSSoiu6UCIkkIBmLqhAILA90VIS+o64Oi3g+AV+UsSDS+K+UJo2YNsVWME2Tv4ZSHxg/3CAyIaf+Ag5ADBWIjED8bCL0nLnp9s53mkQ+BXhsQPWojED1qIxA/2C78CsC94gODXh8QPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA9aiMQPWojED1qIxA8nhMT9GZAyQinV5jmJsRCJH7QQiR+0EIkftBCJH7QQiR+0EImf/w9N65okGxNU+gAAAABJRU5ErkJggg==";

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
                            $obj->item_picture = $imagebase64;
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
                            $obj->item_picture = $imagebase64;
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
                                $obj->item_picture = $imagebase64;
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
                                $obj->item_picture = $imagebase64;
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