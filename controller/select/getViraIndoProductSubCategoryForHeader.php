<?php
    class getViraIndoProductSubCategoryForHeader{
        // Connection
        private $conn;

        // Db connection
        public function __construct(
            $db
        ){
            $this->conn = $db;
        }
        // GET ALL
        public function getViraIndoProductSubCategoryForHeader(){
            $sqlQuery = "SELECT sc.shopping_category_id, sc.shopping_category_name, c.category_id, c.category_name, suc.sub_category_id, suc.sub_category_name, it.item_id, it.item_name
            from tbl_viraindo_shopping_category sc 
            join tbl_viraindo_category c on sc.shopping_category_id = c.shopping_category_id
            join tbl_viraindo_sub_category suc on suc.category_id = c.category_id
            join tbl_viraindo_item it on it.sub_category_id = suc.sub_category_id;";
            $stmt = $this->conn->prepare($sqlQuery);
            // $stmt->bindValue(":category_id", $categoryId);
            $stmt->execute();
            return $stmt;
        }
        
    }
?>