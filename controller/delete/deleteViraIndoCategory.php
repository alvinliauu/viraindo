<?php
    class deleteViraIndoCategory{
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
            public function deleteViraIndoCategory(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];

                $id = $this->id;

                if($id == null){
                    echo "category not found";
                }
                else{
                    
                    $sqlQuery = "DELETE FROM tbl_viraindo_category
                    WHERE category_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                                
                }

        }

    }
?>