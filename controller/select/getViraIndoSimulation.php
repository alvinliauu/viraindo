<?php

class getViraIndoSimulation{

    private $conn;

    public $keyword;
    public $name;
    public $depends;

    public function __construct($db){
        $this->conn = $db;
    }

    //GET KEYWORD
    public function getViraIndoSimulation(){


        $jsonInput = json_decode(file_get_contents("php://input"), true);
        $this->keyword = $jsonInput["keyword"];
        $this->name = $jsonInput["name"];
        $this->depends = $jsonInput["depends"];

        switch (strtolower($this->name)) {
            case 'brand processor':
                
                $brandProcessor = ['Intel', 'AMD'];
                $brandProcImage = ['imageIntel', 'imageAmd'];

                foreach($brandProcessor as $proc => $index){
                    $val = $brandProcImage[$proc];

                    $results[$proc] = array(
                        "brandProcessor" => $index,
                        "brandPicture" => array(
                            "url" => $val
                        )
                    );
                }

                echo json_encode($results);

                break;
            
            case 'socket':

                if($this->keyword == ""){

                    $sqlQuery = "SELECT sub_category_id as item_id, SUBSTRING_INDEX(sub_category_name, \"Socket \", -1) as item_name, 
                    \"\" as item_new_price, \"\" as item_picture FROM tbl_viraindo_sub_category
                    WHERE sub_category_name LIKE '%$this->depends%' AND sub_category_name LIKE '%processor%' LIMIT 100;";
    
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
    
                    return $stmt;

                }
                else{
                    $arr = explode(" ", $this->keyword);
            
                    if($arr[0] == true){
                        $arrTotal = "";
                        foreach($arr as $index => $count){
                            if($index == 0){
                                $arrTotal .= "SELECT sub_category_id as item_id, SUBSTRING_INDEX(sub_category_name, \"Socket \", -1) as item_name,
                                \"\" as item_new_price, \"\" as item_picture FROM tbl_viraindo_sub_category
                                WHERE sub_category_name LIKE '%$this->depends%' AND sub_category_name LIKE '%processor%' AND sub_category_name like '%$count%' ";
                                continue;
                            }
                            $arrLoop = "AND sub_category_name like '%$count%' ";                             
                        
                            $arrTotal .= $arrLoop;
                        }           
            
                        $sqlQuery = "$arrTotal LIMIT 100;";
            
                        $stmt = $this->conn->prepare($sqlQuery);
                        $stmt->execute();
                        return $stmt;
                    }         
                }

                break;

            case 'processor':

                if($this->keyword == ""){

                    $sqlQuery = "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI
                    JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                    JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                    WHERE TVC.category_name = 'processor' AND TVSC.sub_category_name LIKE '%$this->depends%' LIMIT 100;";
    
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
    
                    return $stmt;

                }
                else{
                    $arr = explode(" ", $this->keyword);
            
                    if($arr[0] == true){
                        $arrTotal = "";
                        foreach($arr as $index => $count){
                            if($index == 0){
                                $arrTotal .= "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI 
                                JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                                JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                                WHERE TVC.category_name = 'processor' AND TVSC.sub_category_name LIKE '%$this->depends%' AND TVI.item_name like '%$count%' ";
                                continue;
                            }
                            $arrLoop = "AND TVI.item_name like '%$count%' ";                             
                        
                            $arrTotal .= $arrLoop;
                        }           
            
                        $sqlQuery = "$arrTotal LIMIT 100;";
            
                        $stmt = $this->conn->prepare($sqlQuery);
                        $stmt->execute();
                        return $stmt;
                    }         
                }

                break;

            case 'motherboard':

                if($this->keyword == ""){

                    $sqlQuery = "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI
                    JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                    JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                    WHERE TVC.category_name = 'motherboard' AND TVSC.sub_category_name LIKE '%$this->depends%' LIMIT 100;";
    
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
    
                    return $stmt;

                }
                else{
                    $arr = explode(" ", $this->keyword);
            
                    if($arr[0] == true){
                        $arrTotal = "";
                        foreach($arr as $index => $count){
                            if($index == 0){
                                $arrTotal .= "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI 
                                JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                                JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                                WHERE TVC.category_name = 'motherboard' AND TVSC.sub_category_name LIKE '%$this->depends%' AND TVI.item_name like '%$count%' ";
                                continue;
                            }
                            $arrLoop = "AND TVI.item_name like '%$count%' ";                             
                        
                            $arrTotal .= $arrLoop;
                        }           
            
                        $sqlQuery = "$arrTotal LIMIT 100;";
            
                        $stmt = $this->conn->prepare($sqlQuery);
                        $stmt->execute();
                        return $stmt;
                    }         
                }

                break;

            case 'ram':
                
                $getNumberPosition = "";
                $getDDRType = "";

                if($this->keyword == ""){


                    $SqlGetNumberPosition = "SELECT LOCATE(\"DDR\", \"$this->depends\") AS NumberPosition;";
                    $stmtNumberPosition = $this->conn->prepare($SqlGetNumberPosition);

                    $stmtNumberPosition->execute();
                    $NumberPosition = $stmtNumberPosition->fetch(PDO::FETCH_ASSOC);
                    $getNumberPosition .= $NumberPosition["NumberPosition"];

                    $SqlGetDDRType = "SELECT SUBSTR(\"$this->depends\", $getNumberPosition, 4) AS DDR;";
                    $stmtGetDDRType = $this->conn->prepare($SqlGetDDRType);

                    $stmtGetDDRType->execute();
                    $DDRType = $stmtGetDDRType->fetch(PDO::FETCH_ASSOC);
                    $getDDRType .= $DDRType["DDR"];
                    

                    $sqlQuery = "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI
                    JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                    JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                    WHERE TVC.category_name = 'memory ram' AND TVSC.sub_category_name LIKE '%$getDDRType%' LIMIT 100;";

                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();

                    return $stmt;

                }
                else{
                    $SqlGetNumberPosition = "SELECT LOCATE(\"DDR\", \"$this->depends\") AS NumberPosition;";
                    $stmtNumberPosition = $this->conn->prepare($SqlGetNumberPosition);

                    $stmtNumberPosition->execute();
                    $NumberPosition = $stmtNumberPosition->fetch(PDO::FETCH_ASSOC);
                    $getNumberPosition .= $NumberPosition["NumberPosition"];

                    $SqlGetDDRType = "SELECT SUBSTR(\"$this->depends\", $getNumberPosition, 4) AS DDR;";
                    $stmtGetDDRType = $this->conn->prepare($SqlGetDDRType);

                    $stmtGetDDRType->execute();
                    $DDRType = $stmtGetDDRType->fetch(PDO::FETCH_ASSOC);
                    $getDDRType .= $DDRType["DDR"];

                    $arr = explode(" ", $this->keyword);
            
                    if($arr[0] == true){
                        $arrTotal = "";
                        foreach($arr as $index => $count){
                            if($index == 0){
                                $arrTotal .= "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI
                                JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                                JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                                WHERE TVC.category_name = 'memory ram' AND TVSC.sub_category_name LIKE '%$getDDRType%' AND TVI.item_name like '%$count%' ";
                                continue;
                            }
                            $arrLoop = "AND TVI.item_name like '%$count%' ";                             
                        
                            $arrTotal .= $arrLoop;
                        }           
            
                        $sqlQuery = "$arrTotal LIMIT 100;";
            
                        $stmt = $this->conn->prepare($sqlQuery);
                        $stmt->execute();
                        return $stmt;
                    }
                }
                

                break;

            default:

                if($this->keyword == ""){

                    $sqlQuery = "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI
                    JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                    JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                    WHERE TVC.category_name = '$this->name' LIMIT 100;";
    
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
    
                    return $stmt;

                }
                else{
                    $arr = explode(" ", $this->keyword);
            
                    if($arr[0] == true){
                        $arrTotal = "";
                        foreach($arr as $index => $count){
                            if($index == 0){
                                $arrTotal .= "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI 
                                JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                                JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                                WHERE TVC.category_name = '$this->name' AND TVI.item_name like '%$count%' ";
                                continue;
                            }
                            $arrLoop = "AND TVI.item_name like '%$count%' ";                             
                        
                            $arrTotal .= $arrLoop;
                        }           
            
                        $sqlQuery = "$arrTotal LIMIT 100;";
            
                        $stmt = $this->conn->prepare($sqlQuery);
                        $stmt->execute();
                        return $stmt;
                    }         
                }

                break;

        }        

    }


}

?>