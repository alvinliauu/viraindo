<?php
    class deleteViraIndoItem{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $subcategory_id;

        // Db connection
        public function __construct(
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function deleteViraIndoItem(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];

                $id = $this->id;

                if($id == null){
                    echo "item not found";
                }
                else{
                    
                    $sqlQuery = "DELETE FROM tbl_viraindo_item
                    WHERE item_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                                
                }

        }

    }
?>