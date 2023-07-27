<?php
    class getViraIndoHistory{
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
            public function getViraIndoHistory(){
     
                $sqlQuery = "SELECT item_name, item_new_price, item_old_price, action, action_by, action_date
                FROM tbl_viraindo_history ORDER BY history_id DESC;";
        
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->execute();
                return $stmt;

        }

    }
?>