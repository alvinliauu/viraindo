<?php
    class deleteViraIndoItem{
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
            public function deleteViraIndoItem(){

                $jsonInput = json_decode(file_get_contents("php://input"), true);            
                $this->id = $jsonInput['id'];
                $this->deletedby = $jsonInput['deletedby'];

                $id = $this->id;
                $deletedby = $this->deletedby;

                $date = date("Y-m-d H:i:s");

                if($id == null){
                    echo "item not found";
                }
                else{
                    $getItem = "SELECT * FROM tbl_viraindo_item WHERE item_id = '$id'";
                    $stmtItem = $this->conn->prepare($getItem);
                    $stmtItem->execute();
                    $item = $stmtItem->fetch(PDO::FETCH_ASSOC);

                    $itemname = $item['item_name'];
                    $itemprice = $item['item_new_price'];
                    $itemoldprice = $item['item_old_price'];

                    
                    $sqlQuery = "DELETE FROM tbl_viraindo_item
                    WHERE item_id = '$id';";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();


                    $HistoryQuery = "INSERT INTO tbl_viraindo_history (item_name, item_new_price, item_old_price, action, action_by, action_date)
                    VALUES ('$itemname', '$itemprice', '$itemoldprice', 'delete $itemname', '$deletedby', '$date');";
            
                    $stmtHistory = $this->conn->prepare($HistoryQuery);
                    $stmtHistory->execute();
                    $stmtHistory->fetch(PDO::FETCH_ASSOC);

                    return $stmt;
                                
                }

        }

    }
?>