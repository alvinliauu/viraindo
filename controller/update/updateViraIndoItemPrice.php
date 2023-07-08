<?php
    class updateViraIndoItemPrice{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $price;
        public $category;

        // Db connection
        public function __construct(
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function updateViraIndoItemPrice(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];
                $this->price = $jsonInput['price'];

                $id = $this->id;
                $price = $this->price;

                if($id == null){
                    echo "item not found";
                }
                else{
                    
                    $sqlQuery = "UPDATE tbl_viraindo_item
                    SET item_price = '$price'
                    WHERE item_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                                
                }

        }

    }
?>