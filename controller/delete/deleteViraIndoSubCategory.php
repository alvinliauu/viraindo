<?php
    class deleteViraIndoSubCategory{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $deletedby;

        // Db connection
        public function __construct(
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function deleteViraIndoSubCategory(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];
                $this->deletedby = $jsonInput['user'];

                $id = $this->id;
                $deletedby = $this->deletedby;
                $date = date("Y-m-d H:i:s");


                if($id == null){
                    echo "sub category not found";
                }
                else{
                    $getSubCategory = "SELECT * FROM tbl_viraindo_subcategory WHERE sub_category_id = '$id";
                    $stmtSubCategory = $this->conn->prepare($getSubCategory);
                    $stmtSubCategory->execute();

                    $subCategory = $stmtSubCategory->fetch(PDO::FETCH_ASSOC);

                    $subCategoryName = $subCategory['sub_category_name'];


                    $deleteItemQuery = "DELETE FROM tbl_viraindo_item
                    WHERE sub_category_id = '$id';";
        
                    $stmtDeleteItem = $this->conn->prepare($deleteItemQuery);
                    $stmtDeleteItem->execute();

                    
                    $sqlQuery = "DELETE FROM tbl_viraindo_sub_category
                    WHERE sub_category_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    

                    $HistoryQuery = "INSERT INTO tbl_viraindo_history (item_name, item_new_price, item_old_price, action, action_by, action_date)
                    VALUES ('delete subcategory $subCategoryName', '0', '0', 'delete subcategory $subCategoryName', '$deletedby', '$date');";
            
                    $stmtHistory = $this->conn->prepare($HistoryQuery);
                    $stmtHistory->execute();
                    $stmtHistory->fetch(PDO::FETCH_ASSOC);

                    return $stmt;
                                
                }

        }

    }
?>