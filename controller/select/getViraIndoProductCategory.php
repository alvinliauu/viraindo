<?php

    class getViraIndoProductCategory{
        // Connection
        private $conn;
        
        // Table
        private $db_table = "tbl_viraindo_category";

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getViraIndoProductCategory(){
            $sqlQuery = "SELECT category_id, category_name, category_stock, isActive FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
    }
?>