<?php

    class getViraIndoHome{
        // Connection
        private $conn;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getViraIndoHome(){
            $sqlQuery = "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
            ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name IN ('keyboard', 'mouse', 'headset') ORDER BY RAND() LIMIT 10;";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoItemUnderPrice(){
            $sqlQuery = "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
            ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name IN ('keyboard', 'mouse', 'headset') AND
            TVI.item_new_price < 300000 ORDER BY RAND() LIMIT 10;";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoComputerComponent(){
            $sqlQuery = "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
            ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name IN ('motherboard', 'processor', 'ram', 'casing', 'vga', 'psu', 'cooler', 'audio', 'hdd', 'ssd') AND
            TVI.item_new_price > 100000 ORDER BY RAND() LIMIT 10;";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoRecommended(){
            $sqlQuery = "SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
            ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name IN ('processor', 'ram', 'vga', 'cooler', 'audio', 'ssd') AND
            TVI.item_new_price > 100000 ORDER BY RAND() LIMIT 50;";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
    }
?>