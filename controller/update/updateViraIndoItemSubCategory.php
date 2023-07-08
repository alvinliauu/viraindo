<?php
    class updateViraIndoItemSubCategory{
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
            public function updateViraIndoItemSubCategory(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];
                $this->subcategory_id = $jsonInput['subcategory_id'];

                $id = $this->id;
                $subcategory_id = $this->subcategory_id;

                if($id == null){
                    echo "item not found";
                }
                else{
                    
                    $sqlQuery = "UPDATE tbl_viraindo_item
                    SET sub_category_id = '$subcategory_id'
                    WHERE item_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                                
                }

        }

    }
?>