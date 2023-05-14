<?php

    class getViraIndoCategoryFilter{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $category;
        public $price;

        // Db connection
        public function __construct($db, $id, $name, $price){
                $this->conn = $db;
                $this->$id = $id;
                $this->$name = $name;
                $this->$price = $price;
            }

            // GET ALL
            public function getViraIndoCategoryFilter(){

            if($this->name == null){
                echo "item not found";
            }
            else{
                if($this->name[0] == true){
                    $arrTotal = "";
                    foreach($this->name as $index => $count){
                        if($index == 0){
                            $arrTotal .= "SELECT TVC.category_name, TVSC.sub_category_id, TVSC.sub_category_name, GROUP_CONCAT(TVI.item_id ORDER BY TVI.item_new_price $this->price SEPARATOR '$^$') AS item_id, GROUP_CONCAT(TVI.item_name ORDER BY TVI.item_new_price $this->price SEPARATOR '$^$') AS item_name,
                            GROUP_CONCAT(TVI.item_picture ORDER BY TVI.item_new_price $this->price SEPARATOR '$^$') AS item_picture, GROUP_CONCAT(TVI.item_new_price ORDER BY TVI.item_new_price $this->price SEPARATOR '$^$') AS item_price
                            FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                            JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                            WHERE TVI.item_name LIKE '%$count%'
                            ";
                            continue;
                        }
                        $arrLoop = "AND TVI.item_name LIKE '%$count%'";                             
                    
                        $arrTotal .= $arrLoop;
                    }           
    
                    $sqlQuery = "$arrTotal AND TVSC.sub_category_id = $this->id GROUP BY TVSC.sub_category_id;";
    
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                }
                else{
                    $sqlQuery = "SELECT TVC.category_name, TVSC.sub_category_id, TVSC.sub_category_name, GROUP_CONCAT(TVI.item_id ORDER BY TVI.item_new_price $this->price SEPARATOR '$^$') AS item_id, GROUP_CONCAT(TVI.item_name ORDER BY TVI.item_new_price $this->price SEPARATOR '$^$') AS item_name,
                    GROUP_CONCAT(TVI.item_picture ORDER BY TVI.item_new_price $this->price SEPARATOR '$^$') AS item_picture, GROUP_CONCAT(TVI.item_new_price ORDER BY TVI.item_new_price $this->price SEPARATOR '$^$') AS item_price
                    FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                    JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                    WHERE TVSC.sub_category_id = $this->id GROUP BY TVSC.sub_category_id;";
                    $stmt = $this->conn->prepare($sqlQuery);
                    
                    $stmt->execute();
                    return $stmt;
                }                
            }



        }

    }
?>