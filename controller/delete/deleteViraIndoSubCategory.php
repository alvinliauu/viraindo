<?php
    class deleteViraIndoSubCategory{
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
            public function deleteViraIndoSubCategory(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];

                $id = $this->id;

                if($id == null){
                    echo "sub category not found";
                }
                else{
                    
                    $sqlQuery = "DELETE FROM tbl_viraindo_sub_category
                    WHERE sub_category_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                                
                }

        }

    }
?>