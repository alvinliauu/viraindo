<?php
    class deleteViraIndoCategory{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $subcategory_id;
        public $deletedby;

        // Db connection
        public function __construct(
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function deleteViraIndoCategory(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];
                $this->deletedby = $jsonInput['user'];

                $id = $this->id;
                $deletedby = $this->deletedby;
                $date = date("Y-m-d H:i:s");

                if($id == null){
                    echo "category not found";
                }
                else{
                    $getCategory = "SELECT * FROM tbl_viraindo_category WHERE category_id = '$id";
                    $stmtCategory = $this->conn->prepare($getCategory);
                    $stmtCategory->execute();

                    $Category = $stmtCategory->fetch(PDO::FETCH_ASSOC);

                    $CategoryName = $Category['category_name'];


                    $getSubCategory = "SELECT * FROM tbl_viraindo_subcategory WHERE category_id = '$id";
                    $stmtSubCategory = $this->conn->prepare($getSubCategory);
                    $stmtSubCategory->execute();

                    $subCategory = $stmtSubCategory->fetch(PDO::FETCH_ASSOC);

                    for($x = 0; $x < count($subCategory); $x++){

                        $subCategoryId = $subCategory['sub_category_id'];

                        $deleteItemQuery = "DELETE FROM tbl_viraindo_category
                        WHERE sub_category_id = '$subCategoryId';";
            
                        $stmtDeleteItem = $this->conn->prepare($deleteItemQuery);
                        $stmtDeleteItem->execute();
                    }

                    $deleteSubCategoryQuery = "DELETE FROM tbl_viraindo_sub_category
                    WHERE category_id = '$id';";
        
                    $stmtDeleteSubcategory = $this->conn->prepare($deleteSubCategoryQuery);
                    $stmtDeleteSubcategory->execute();


                    $sqlQuery = "DELETE FROM tbl_viraindo_category
                    WHERE category_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();


                    $HistoryQuery = "INSERT INTO tbl_viraindo_history (item_name, item_new_price, item_old_price, action, action_by, action_date)
                    VALUES ('delete category $CategoryName', '0', '0', 'delete category $CategoryName', '$deletedby', '$date');";
            
                    $stmtHistory = $this->conn->prepare($HistoryQuery);
                    $stmtHistory->execute();
                    $stmtHistory->fetch(PDO::FETCH_ASSOC);



                    return $stmt;
                                
                }

        }

    }
?>