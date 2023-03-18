<?php
    class getViraIndoProductSubCategory{
        // Connection
        private $conn;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getViraIndoProductCategory($categoryId){
            $sqlQuery = "SELECT sub_category_name, isActive FROM tbl_viraindo_subcategory WHERE category_id = :category_id";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindValue(":category_id", $categoryId);
            $stmt->execute();
            return $stmt;
        }
        
    }
?>