<?php
    class getViraIndoSearch{
        // Connection
        private $conn;
        public $id;
        public $name;

        // Db connection
        public function __construct(
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function getViraIndoSearch(){

            $jsonInput = json_decode(file_get_contents("php://input"), true);
            $this->name = $jsonInput['name'];

            $sqlQuery = "SELECT item_id, item_name FROM tbl_viraindo_item WHERE item_name like '%$this->name%' LIMIT 9;";
            $stmt = $this->conn->prepare($sqlQuery);

            // $stmt->bindValue(':item_name', $this->name);
            // $rowCount = '2';
            // $stmt->bindValue(':rowCount', $rowCount);

            $stmt->execute();

            return $stmt;
        }

    //     public  function getTest($itemName = null) {

    //         if ($itemName === false) {
    //             return false;
    //         }

    //         $list = [];
    //         $req = $this->conn->prepare('SELECT * FROM tbl_viraindo_item where item_name=:item_name');

    //         $req->execute(array(':item_name' => $itemName));

    //         foreach($req->fetchAll() as $res) {
    //         //   $list[]= new Researchers($res['item_id'], $res['item_name']);
    //         }
    //         return $list;
    //   }

    }
?>