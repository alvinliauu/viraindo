<?php
    class getViraIndoItemList{
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
            public function getViraIndoItemList(){

            $jsonInput = json_decode(file_get_contents("php://input"), true);            
            $this->name = $jsonInput['name'];
            $this->category = $jsonInput['category'];

            $arr = explode(" ", $this->name);
            $thecategory = $this->category;

            if($jsonInput == null){
                echo "item not found";
            }
            else{
                if($arr[0] == true){
                    $arrTotal = "";
                    foreach($arr as $index => $count){
                        if($index == 0){
                            $arrTotal .= "SELECT TVSC.sub_category_id, TVSC.sub_category_name, GROUP_CONCAT(TVI.item_id SEPARATOR '$^$') AS item_id, GROUP_CONCAT(TVI.item_name SEPARATOR '$^$') AS item_name,
                            GROUP_CONCAT(TVI.item_picture SEPARATOR '$^$') AS item_picture, GROUP_CONCAT(TVI.item_new_price SEPARATOR '$^$') AS item_price
                            FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                            JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                            WHERE TVI.item_name LIKE '%$count%' ";
                            continue;
                        }
                        $arrLoop = "AND TVI.item_name like '%$count%' ";                             
                    
                        $arrTotal .= $arrLoop;
                    }           
    
                    $sqlQuery = "$arrTotal AND TVC.category_name LIKE '%$thecategory%' GROUP BY TVSC.sub_category_id;";
    
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                }
                else{
                    $sqlQuery = "SELECT TVSC.sub_category_id, TVSC.sub_category_name, GROUP_CONCAT(TVI.item_id SEPARATOR '$^$') AS item_id, GROUP_CONCAT(TVI.item_name SEPARATOR '$^$') AS item_name,
                    GROUP_CONCAT(TVI.item_picture SEPARATOR '$^$') AS item_picture, GROUP_CONCAT(TVI.item_new_price SEPARATOR '$^$') AS item_price
                    FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                    JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                    WHERE TVI.item_name LIKE '%$this->name%' AND TVC.category_name LIKE '%$thecategory%'
                    GROUP BY TVSC.sub_category_id;";
                    $stmt = $this->conn->prepare($sqlQuery);
                    
                    $stmt->execute();
                    return $stmt;
                }                
            }



        }

    }
?>