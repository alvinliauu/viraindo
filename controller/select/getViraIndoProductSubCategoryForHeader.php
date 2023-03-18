<?php
    class getViraIndoProductSubCategoryForHeader{
        // Connection
        private $conn;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getViraIndoProductCategory($categoryId){
            $sqlQuery = "SELECT";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindValue(":category_id", $categoryId);
            $stmt->execute();
            return $stmt;
        }
        
    }
?>