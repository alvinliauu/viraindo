<?php

class insertViraIndoSubCategory{

    private $conn;

    public $keyword;
    public $name;
    public $depends;
    public $price;
    public $category;
    public $subcategory;
    public $image;
    public $insertby;
    public $categoryid;

    public function __construct($db){
        $this->conn = $db;
    }

    //GET KEYWORD
    public function insertViraIndoSubCategory(){

        $date = date("Y-m-d H:i:s");

        $jsonInput = json_decode(file_get_contents("php://input"), true);
        $this->name = $jsonInput["name"];
        $this->categoryid = $jsonInput["categoryid"];
        $this->insertby = $jsonInput["insertby"];

        $sqlQuery = "INSERT INTO tbl_viraindo_sub_category (category_id, sub_category_name, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy)
        VALUES ('$this->categoryid', '$this->name', '1', '$date', '$this->insertby', '1', '$date', '$this->insertby')"; 

        $stmt = $this->conn->prepare($sqlQuery);
        // $stmt->bindValue(":category_id", $categoryId);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }

    }


}

?>