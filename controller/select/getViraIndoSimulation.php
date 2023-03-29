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
                        WHERE TVC.category_name = '$this->name' AND item_name like '%$count%' ";
                        continue;
                    }
                    $arrLoop = "AND item_name like '%$count%' ";                             
                
                    $arrTotal .= $arrLoop;
                }           
    
                $sqlQuery = "$arrTotal LIMIT 100;";
    
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->execute();
                return $stmt;
            }         
        }

    }


}

?>