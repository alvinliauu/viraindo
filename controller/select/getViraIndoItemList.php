<?php
    class getViraIndoItemList{
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
            public function getViraIndoItemList(){
     
                $sqlQuery = "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_old_price, TVI.item_picture
                FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id;";
        
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->execute();
                return $stmt;

        }

    }
?>