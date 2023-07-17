<?php

class insertViraIndoCategory{

    private $conn;

    public $keyword;
    public $name;
    public $depends;
    public $price;
    public $category;
    public $subcategory;
    public $image;
    public $insertby;

    public function __construct($db){
        $this->conn = $db;
    }

    //GET KEYWORD
    public function insertViraIndoCategory(){

        $date = date("Y-m-d H:i:s");

        $jsonInput = json_decode(file_get_contents("php://input"), true);
        $this->name = $jsonInput["name"];
        $this->insertby = $jsonInput["insertby"];

        $sqlQuery = "INSERT INTO tbl_viraindo_category (category_name, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy)
        VALUES ('$this->name', '1', '$date', '$this->insertby', '1', '$date', '$this->insertby')"; 

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