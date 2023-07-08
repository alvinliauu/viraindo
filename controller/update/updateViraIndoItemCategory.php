<?php
    class updateViraIndoItemCategory{
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
            public function updateViraIndoItemCategory(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];
                $this->name = $jsonInput['name'];

                $id = $this->id;
                $name = $this->name;

                if($id == null){
                    echo "item not found";
                }
                else{
                    
                    $sqlQuery = "UPDATE tbl_viraindo_item
                    SET item_category = '$name'
                    WHERE item_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                                
                }

        }

    }
?>