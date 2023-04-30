<?php
    class getViraIndoItemList{
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
            public function getViraIndoItemList(){

            $jsonInput = json_decode(file_get_contents("php://input"), true);            
            $this->name = $jsonInput['name'];

            $arr = explode(" ", $this->name);

            if($jsonInput == null){
                echo "item not found";
            }
            else{
                if($arr[0] == true){
                    $arrTotal = "";
                    foreach($arr as $index => $count){
                        if($index == 0){
                            $arrTotal .= "SELECT TVSC.sub_category_id, TVSC.sub_category_name, GROUP_CONCAT(TVI.item_name SEPARATOR '$^$') AS item_name,
                            GROUP_CONCAT(TVI.item_picture SEPARATOR '$^$') AS item_picture, GROUP_CONCAT(TVI.item_new_price SEPARATOR '$^$') AS item_price
                            FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id 
                            WHERE TVI.item_name LIKE '%$count%' ";
                            continue;
                        }
                        $arrLoop = "AND TVI.item_name like '%$count%' ";                             
                    
                        $arrTotal .= $arrLoop;
                    }           
    
                    $sqlQuery = "$arrTotal GROUP BY TVSC.sub_category_id;;";
    
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                }
                else{
                    $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name, GROUP_CONCAT(TVI.item_name SEPARATOR '$^$') AS item_name,
                    GROUP_CONCAT(TVI.item_picture SEPARATOR '$^$') AS item_picture, GROUP_CONCAT(TVI.item_new_price SEPARATOR '$^$') AS item_price
                    FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id 
                    WHERE TVI.item_name LIKE '%$this->name%'
                    GROUP BY TVSC.sub_category_id;";
                    $stmt = $this->conn->prepare($sqlQuery);
                    
                    $stmt->execute();
                    return $stmt;
                }                
            }



        }

    }
?>