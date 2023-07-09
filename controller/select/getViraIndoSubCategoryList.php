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

                $jsonInput = json_decode(file_get_contents("php://input"), true);
                $this->id = $jsonInput["id"];
     
                $sqlQuery = "SELECT category_id, sub_category_id, sub_category_name
                FROM tbl_viraindo_sub_category WHERE category_id = '$this->id';";
        
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->execute();
                return $stmt;

        }

    }
?>