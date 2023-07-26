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

        $insertby = $this->insertby;
        $name = $this->name;
        $image = $this->image;
        $subcategory = $this->subcategory;
        $price = $this->price;

        $sqlQuery = "INSERT INTO tbl_viraindo_item (sub_category_id, item_name, item_picture, item_new_price, item_old_price, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy)
        VALUES ('$subcategory', '$name', '$image', '$price', '$price', '1', '$date', '$insertby', '1', '$date', '$insertby')"; 

        $stmt = $this->conn->prepare($sqlQuery);
        // $stmt->bindValue(":category_id", $categoryId);

        if($stmt->execute()){

            $HistoryQuery = "INSERT INTO tbl_viraindo_history (item_name, item_new_price, item_old_price, action, action_by, action_date)
            VALUES ('$name', '$price', '$price', 'insert item', '$insertby', '$date');";
    
            $stmtHistory = $this->conn->prepare($HistoryQuery);
            $stmtHistory->execute();
            $stmtHistory->fetch(PDO::FETCH_ASSOC);

            return true;
        } else {
            return false;
        }

    }


}

?>