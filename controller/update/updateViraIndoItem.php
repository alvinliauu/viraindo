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
                $updatedby = $this->updatedby;

                if($id == null){
                    echo "item not found";
                }
                else{

                    $getItem = "SELECT * FROM tbl_viraindo_item WHERE item_id = '$id'";

                    $stmtItem = $this->conn->prepare($getItem);
                    $stmtItem->execute();

                    $item = $stmtItem->fetch(PDO::FETCH_ASSOC);

                    $oldprice = $item['item_new_price'];
                    $date = date('Y-m-d');

                    if (empty($id)){
                        $id = $item['item_id'];
                    }
                    if (empty($name)) {
                        $name = $item['item_name'];
                    } 
                    if (empty($price)) {
                        $price = $item['item_new_price'];
                        $oldprice = $item['item_old_price'];
                    }
                    if (empty($subcategory)) {
                        $subcategory = $item['sub_category_id'];
                    }
                    if (empty($image)) {
                        $image = $item['image'];
                    }                    
                    
                    $sqlQuery = "UPDATE tbl_viraindo_item
                    SET sub_cateogry_id = '$subcategory', item_name = '$name', item_new_price = '$price', item_old_price = '$oldprice', item_image = '$image', updatedOn = '$date', updatedBy = '$updatedby'
                    WHERE item_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();

                    $HistoryQuery = "INSERT INTO tbl_viraindo_history (item_name, item_new_price, item_old_price, action, action_by, action_date)
                    VALUES ('$name', '$price', '$oldprice', 'update item', '$updatedby', '$date');";
            
                    $stmtHistory = $this->conn->prepare($HistoryQuery);
                    $stmtHistory->execute();
                    $stmtHistory->fetch(PDO::FETCH_ASSOC);

                    
                    return $stmt;
                                
                }

        }

    }
?>