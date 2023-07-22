<?php
    class updateViraIndoItem{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $price;
        public $category;
        public $subcategory;
        public $image;
        public $updatedby;

        // Db connection
        public function __construct(
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function updateViraIndoItem(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];
                $this->name = $jsonInput['name'];
                $this->price = $jsonInput['price'];
                $this->subcategory = $jsonInput['subcategory'];
                $this->image = $jsonInput['image'];
                $this->updatedby = $jsonInput['updatedby'];

                $id = $this->id;
                $name = $this->name;
                $price = $this->price;
                $subcategory = $this->subcategory;
                $image = $this->image;

                if($id == null){
                    echo "item not found";
                }
                else{

                    $getItemOldPrice = "SELECT * FROM tbl_viraindo_item";

                    $stmt = $this->conn->prepare($getItemOldPrice);
                    $stmt->execute();

                    
                    // $sqlQuery = "UPDATE tbl_viraindo_item
                    // SET sub_cateogry_id = '$subcategory', item_name = '$name', item_new_price = '$price', item_image = '$image'
                    // WHERE item_id = '$id';";
        
                    // $stmt = $this->conn->prepare($sqlQuery);
                    // $stmt->execute();
                    return $stmt;
                                
                }

        }

    }
?>