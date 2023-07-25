<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/repository/filter.php';

    class getViraIndoCategoryFilter{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $filter;
        public $category;
        public $price;

        // Db connection
        public function __construct(
            $db, $id, $filter, $price
            ){
                $this->conn = $db;
                $this->id = $id;
                $this->filter = $filter;
                $this->price = $price;
            }

            // GET ALL
            public function getViraIndoCategoryFilter(){

                if($this->filter[0] == true){
                    
                    $arrTotal = "";
                    foreach($this->filter as $index => $count){
                        if($index == 0){
                            $arrTotal .= "SELECT TVC.category_name, TVSC.sub_category_id, TVSC.sub_category_name, GROUP_CONCAT(TVI.item_id $this->price SEPARATOR '$^$') AS item_id, GROUP_CONCAT(TVI.item_name $this->price SEPARATOR '$^$') AS item_name,
                            GROUP_CONCAT(TVI.item_picture $this->price SEPARATOR '$^$') AS item_picture, GROUP_CONCAT(TVI.item_new_price $this->price SEPARATOR '$^$') AS item_price
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
                    $sqlQuery = "SELECT TVC.category_name, TVSC.sub_category_id, TVSC.sub_category_name, GROUP_CONCAT(TVI.item_id $this->price SEPARATOR '$^$') AS item_id, GROUP_CONCAT(TVI.item_name $this->price SEPARATOR '$^$') AS item_name,
                    GROUP_CONCAT(TVI.item_picture $this->price SEPARATOR '$^$') AS item_picture, GROUP_CONCAT(TVI.item_new_price $this->price SEPARATOR '$^$') AS item_price
                    FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                    JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                    WHERE TVSC.sub_category_id = $this->id GROUP BY TVSC.sub_category_id;";
                    $stmt = $this->conn->prepare($sqlQuery);
                    
                    $stmt->execute();

                    return $stmt;
                }                    

            }

            public function getViraIndoCategoryFilterItemNull(){
  
               
                    $sqlQuery = "SELECT TVC.category_name, TVSC.sub_category_id, TVSC.sub_category_name
                    FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                    JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                    WHERE TVSC.sub_category_id = $this->id LIMIT 1;";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                 
            }

    }
?>