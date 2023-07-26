<?php
    class updateViraIndoItemCategory{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $updatedby;

        // Db connection
        public function __construct(
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function updateViraIndoItemCategory(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];
                $this->name = $jsonInput['name'];
                $this->updatedby = $jsonInput['updatedby'];

                $id = $this->id;
                $name = $this->name;
                $updatedby = $this->updatedby;

                $date = date('Y-m-d H:i:s');

                if($id == null){
                    echo "item not found";
                }
                else{
                    
                    $sqlQuery = "UPDATE tbl_viraindo_item
                    SET item_category = '$name'
                    WHERE item_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();

                    $HistoryQuery = "INSERT INTO tbl_viraindo_history (item_name, item_new_price, item_old_price, action, action_by, action_date)
                    VALUES ('update category', '0', '0', 'update category $name', '$updatedby', '$date');";
            
                    $stmtHistory = $this->conn->prepare($HistoryQuery);
                    $stmtHistory->execute();
                    $stmtHistory->fetch(PDO::FETCH_ASSOC);

                    return $stmt;
                                
                }

        }

    }
?>