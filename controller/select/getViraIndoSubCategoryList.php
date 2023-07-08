<?php
    class getViraIndoSubCategoryList{
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
            public function getViraIndoSubCategoryList(){
     
                $sqlQuery = "SELECT sub_category_id, sub_category_name
                FROM tbl_viraindo_sub_category;";
        
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->execute();
                return $stmt;

        }

    }
?>