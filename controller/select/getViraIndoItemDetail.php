<?php
    class getViraIndoItemDetail{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $category;

        // Db connection
        public function __construct(
            $db, $id
            ){
                $this->conn = $db;
                $this->id = $id;
            }

            // GET ALL
        public function getViraIndoItemDetail(){

            // $jsonInput = json_decode(file_get_contents("php://input"), true);            
            // $this->id = $jsonInput['id'];

            $sqlQuery = "SELECT TVC.category_name, TVSC.sub_category_name, TVI.item_name, TVI.item_picture, TVI.item_new_price 
            FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC ON TVC.category_id = TVSC.category_id 
            JOIN tbl_viraindo_item TVI ON TVSC.sub_category_id = TVI.sub_category_id WHERE item_id = '$this->id';";
                            
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;                       

        }

        public function getViraIndoItemLainnya(){

            $sqlQuery = "SELECT TVC.category_name, TVSC.sub_category_name, TVI.item_name, TVI.item_picture, TVI.item_new_price 
            FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC ON TVC.category_id = TVSC.category_id 
            JOIN tbl_viraindo_item TVI ON TVSC.sub_category_id = TVI.sub_category_id WHERE item_id = '$this->id';";
                            
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            print_r($stmt);die();

            $QueryOfItemLainnya = "SELECT TVC.category_name, TVSC.sub_category_name, TVI.item_name, TVI.item_picture, TVI.item_new_price 
            FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC ON TVC.category_id = TVSC.category_id 
            JOIN tbl_viraindo_item TVI ON TVSC.sub_category_id = TVI.sub_category_id WHERE item_id = '$this->id'
            ORDER BY RAND() LIMIT 10;";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            return $stmt;                       

        }

    }
?>