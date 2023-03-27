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

        switch($this->name){

            case "processor":
            
                $sqlQuery = "SELECT * FROM tbl_viraindo_processor;";
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->execute();
                return $stmt;

                

        }

        // $arr = explode(" ", $this->keyword);

        // if($arr[0] == true){
        //     $arrTotal = "";
        //     foreach($arr as $index => $count){
        //         if($index == 0){
        //             $arrTotal .= "SELECT item_id, item_name FROM tbl_viraindo_item WHERE 
        //             item_name like '%$count%' ";
        //             continue;
        //         }
        //         $arrLoop = "AND item_name like '%$count%' ";                             
            
        //         $arrTotal .= $arrLoop;
        //     }           

        //     $sqlQuery = "$arrTotal LIMIT 5;";

        //     $stmt = $this->conn->prepare($sqlQuery);
        //     $stmt->execute();
        //     return $stmt;
        // }
        // else{
        //     $sqlQuery = "SELECT item_id, item_name FROM tbl_viraindo_item WHERE 
        //     item_name like '%$this->name%'
        //     LIMIT 5;";
        //     $stmt = $this->conn->prepare($sqlQuery);
            
        //     $stmt->execute();
        //     return $stmt;
        // }

    }


}

?>