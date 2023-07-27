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
        $this->insertby = $jsonInput["user"];

        $insertby = $this->insertby;
        $name = $this->name;
        $categoryid = $this->categoryid;
        $price = $this->price;

        $subcategoryname = "subcategory " . $name;

        $sqlQuery = "INSERT INTO tbl_viraindo_sub_category (category_id, sub_category_name, isActive, updatedOn, updatedBy, updatedCount, insertedOn, insertedBy)
        VALUES ('$categoryid', '$name', '1', '$date', '$insertby', '1', '$date', '$insertby')"; 

        $stmt = $this->conn->prepare($sqlQuery);
        // $stmt->bindValue(":category_id", $categoryId);

        if($stmt->execute()){

            $HistoryQuery = "INSERT INTO tbl_viraindo_history (item_name, item_new_price, item_old_price, action, action_by, action_date)
            VALUES ('$subcategoryname', '0', '0', 'insert sub category', '$insertby', '$date');";
    
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