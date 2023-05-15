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
            $db
            ){
                $this->conn = $db;
            }

            // GET ALL
            public function getViraIndoCategoryFilter(){

                $arrTest1 = [];
                $arrTest2 = [];
                $theArr = [];

                $test1 = ["Adata", "Apacer", "Corsair", "Crucial Ballistix", "Team T-Force", "Team Elite Plus", "V-Color", "V-GeN", "4GB", "8GB", "16GB", "32GB", "64GB"]; //filter
            
                $test2 = ["AMD", "ASRock", "Asus", "Colorful", "Galax", "Gigabyte", "2GB", "4GB", "6GB", "8GB", "10GB", "12GB", "24GB"]; //keyword


                foreach($test2 as $key => $value){
                    $obj = new stdClass();
                    $obj->name = $value;

                    array_push($arrTest2, $obj);
                    
                }

                foreach($test1 as $key => $value){

                    $obj = new stdClass();
                    $obj->name = $value;

                    array_push($arrTest1, $obj);
                    
                }

                foreach ($arrTest1 as $key => $value) {
                    
                    if(array_intersect($arrTest1, $arrTest2)){
                        $val = 1;
                    }else $val = 0;

                    $obj = new stdClass();
                    $obj->name = $value;
                    $obj->val = $val;

                    array_push($theArr, $obj);
                }


                print_r($theArr);

                die();



            $jsonInput = json_decode(file_get_contents("php://input"), true);
            $this->id = $jsonInput['id'];
            $this->filter = $jsonInput['filter'];
            $this->price = $jsonInput['price'];

            if(isset($this->filter)){
                foreach ($this->filter as $filt){
                    $name = $filt["name"];
                    
                    $arr[] = $name;
                }
            }

            if($this->price == ""){
                $this->price = "asc";
            }

            // filter("", $arr);

            if($jsonInput == null){
                echo "item not found";
            }
            else{
                if($arr[0] == true){
                    $arrTotal = "";
                    foreach($arr as $index => $count){
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