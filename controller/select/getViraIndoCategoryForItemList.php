<?php
    class getViraIndoCategoryForItemList{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $category;

        // Db connection
        public function __construct(
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function getViraIndoCategoryForItemList(){

            $jsonInput = json_decode(file_get_contents("php://input"), true);            
            $this->id = $jsonInput['id'];

            $sub_category_id = $this->id;

            if($sub_category_id == null){
                echo "item not found";
            }
            else{

                $sqlQuery = "SELECT TVC.category_name, TVSC.sub_category_id, TVSC.sub_category_name, GROUP_CONCAT(TVI.item_id ORDER BY TVI.item_id DESC SEPARATOR '$^$') AS item_id, GROUP_CONCAT(TVI.item_name ORDER BY TVI.item_id DESC SEPARATOR '$^$') AS item_name,
                GROUP_CONCAT(TVI.item_picture ORDER BY TVI.item_id DESC SEPARATOR '$^$') AS item_picture, GROUP_CONCAT(TVI.item_new_price ORDER BY TVI.item_id DESC SEPARATOR '$^$') AS item_price
                FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                WHERE TVSC.sub_category_id = $sub_category_id 
                GROUP BY TVSC.sub_category_id;";
    
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->execute();
                return $stmt;
                               
            }


        }

    }
?>