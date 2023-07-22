<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/repository/filter.php';

    class getViraIndoSearchPage{
        // Connection
        private $conn;
        public $id;
        public $name;
        public $filter;
        public $category;
        public $price;

        // Db connection
        public function __construct(
            $db, $name, $filter, $price
            ){
                $this->conn = $db;
                $this->name = $name;
                $this->filter = $filter;
                $this->price = $price;
            }

            // GET ALL
            public function getViraIndoItemFilter(){

                print_r($this->price);
                die();

                if($this->name[0] == true){
                    
                    $arr = explode(" ", $this->name);

                    $arrTotal = "";

                    foreach($arr as $index => $count){
                        
                        if($index == 0){
                            $arrTotal .= "SELECT TVI.item_id, TVI.item_name, TVI.item_picture, TVI.item_new_price
                            FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                            JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id WHERE TVI.item_name LIKE '%$count%'
                            ";
                            continue;
                        }
                        $arrLoop = "AND TVI.item_name LIKE '%$count%'";                             
                    
                        $arrTotal .= $arrLoop;
                    }
                    
                    if($this->filter[0] == true){
                        $filterTotal = "";
                        foreach($this->filter as $index => $value){
                            if($index == 0){
                                $filterTotal .= "('$value'";
                                continue;
                            }
                            $filterLoop = ", '$value'";

                            $filterTotal .= $filterLoop;
                        }
                        $allFilter = "$filterTotal)";

                        $sqlQuery = "$arrTotal AND TVC.category_name IN $allFilter $this->price;";
                    }
                    else{
                        $sqlQuery = "$arrTotal $this->price;";
                    }                    

                    print_r($sqlQuery);die();

                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();

                    return $stmt;
                }                
                else{
                    $arrTotal = "";

                    $arrTotal .= "SELECT TVI.item_id, TVI.item_name, TVI.item_picture, TVI.item_new_price
                    FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                    JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id";

                    if($this->filter[0] == true){
                        $filterTotal = "";
                        foreach($this->filter as $index => $value){
                            if($index == 0){
                                $filterTotal .= "('$value'";
                                continue;
                            }
                            $filterLoop = ", '$value'";

                            $filterTotal .= $filterLoop;
                        }
                        $allFilter = "$filterTotal)";

                        $sqlQuery = "$arrTotal WHERE TVC.category_name IN $allFilter $this->price;";
                    }
                    else{
                        $sqlQuery = "$arrTotal $this->price;";
                    }    
                    
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                }    

            }

            public function getViraIndoItemFilterItemNull(){
            
                $jsonInput = json_decode(file_get_contents("php://input"), true);
                $this->name = $jsonInput['name'];
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

                if($jsonInput == null){
                    echo "item not found";
                }
                else{
        
                    $sqlQuery = "SELECT TVC.category_name, TVSC.sub_category_id, TVSC.sub_category_name
                    FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
                    JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
                    WHERE TVSC.sub_category_id = $this->id;";
        
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                             
                }

            }

    }
?>