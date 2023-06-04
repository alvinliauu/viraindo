<?php
    class updateViraIndoItemImage{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $image;
        public $category;

        // Db connection
        public function __construct(
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function updateViraIndoItemImage(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];
                $this->image = $jsonInput['image'];

                if($this->id == null){
                    echo "item not found";
                }
                else{

                    $sqlQuery = "UPDATE tbl_viraindo_item
                    SET item_picture = $this->image
                    WHERE item_id = $this->id;";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                                
                }

        }

    }
?>