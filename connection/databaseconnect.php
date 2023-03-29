<?php 
    class Database {

        // private $host = "localhost";
        // private $database_name = "id20509939_viraindo";
        // private $username = "id20509939_viraindo_demo";
        // private $password = "12345#Include";

        private $host = "localhost";
        private $database_name = "u1589432_videmo";
        private $username = "u1589432_janjijiwa";
        private $password = "135#Include";

        // private $host = "localhost";
        // private $database_name = "viraindo_demo";
        // private $username = "root";
        // private $password = "";

        public $conn;
        public function getConnection(){
    
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>