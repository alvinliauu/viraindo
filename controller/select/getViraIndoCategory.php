<?php

    class getViraIndoCategory{
        // Connection
        private $conn;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getViraIndoMotherboard(){
            $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name = 'motherboard';";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoProcessor(){
            $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name = 'processor';";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoSSD(){
            $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name = 'ssd';";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoHDD(){
            $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name = 'hdd';";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoRam(){
            $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name = 'ram';";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoVgaCard(){
            $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name = 'vga';";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoMouse(){
            $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name = 'mouse';";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoKeyboard(){
            $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name = 'keyboard';";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getViraIndoNotebook(){
            $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name FROM tbl_viraindo_category TVC JOIN tbl_viraindo_sub_category TVSC
            ON TVC.category_id = TVSC.category_id WHERE TVC.category_name = 'Notebook';";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
    }
?>