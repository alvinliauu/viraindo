<?php
    class getViraIndoSearch{
        // Connection
        private $conn;
        public $id;
        public $name;

        // Db connection
        public function __construct(
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function getViraIndoSearch(){

            $jsonInput = json_decode(file_get_contents("php://input"), true);            
            $this->name = $jsonInput['name'];

            $arr = explode(" ", $this->name);

            if($jsonInput == null){
                echo "item not found";
            }
            else{
                if($arr[0] == true){
                    $arrTotal = "";
                    foreach($arr as $index => $count){
                        if($index == 0){
                            $arrTotal .= "SELECT item_id, item_name FROM tbl_viraindo_item WHERE
                            item_name like '%$count%' ";
                            continue;
                        }
                        $arrLoop = "AND item_name like '%$count%' ";                             
                    
                        $arrTotal .= $arrLoop;
                    }           
    
                    $sqlQuery = "$arrTotal LIMIT 5;";
    
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();

                    return $stmt;
                }
                else{
                    $sqlQuery = "SELECT item_id, item_name FROM tbl_viraindo_item WHERE 
                    item_name like '%$this->name%'
                    LIMIT 5;";
                    $stmt = $this->conn->prepare($sqlQuery);
                    
                    $stmt->execute();
                    return $stmt;
                }                
            }



        }

    }
?>