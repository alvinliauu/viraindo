<?php

class insertViraIndoItem{

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
    public function insertViraIndoItem(){

        $date = date("Y-m-d H:i:s");

        $jsonInput = json_decode(file_get_contents("php://input"), true);
        $this->name = $jsonInput["name"];
        $this->price = $jsonInput["price"];
        $this->subcategory = $jsonInput["subcategory"];
        $this->image = $jsonInput["image"];
        $this->insertby = $jsonInput["insertby"];

        $sqlQuery = "INSERT INTO tbl_viraindo_item (sub_category_id, item_name, item_picture, item_new_price, item_old_price, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy)
        VALUES ('$this->subcategory', '$this->name', '$this->image', '$this->price', '$this->price', '1', '$date', '$this->insertby', '1', '$date', '$this->insertby')"; 

        $stmt = $this->conn->prepare($sqlQuery);
        // $stmt->bindValue(":category_id", $categoryId);
        $stmt->execute();

        die();
        return $stmt;

    }


}

?>