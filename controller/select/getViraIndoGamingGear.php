<?php

    class getViraIndoGamingGear{
        // Connection
        private $conn;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getViraIndoGamingGear(){
            $sqlQuery = "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
            ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name IN ('keyboard', 'mouse', 'headset') ORDER BY RAND();";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
    }
?>