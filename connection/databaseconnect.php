<?php 

    include_once('../function.php');
    
    class Database {

        private $host = "QZdlXucJJGtO";
        private $database_name = "RskwB7tYeSplTkgsShUAsJ4=";
        private $username = "W5F0XuIPL3c=";
        private $password = "Do43Tb9QJXwK";

        // private $host = "localhost";
        // private $database_name = "viraindo_demo";
        // private $username = "root";
        // private $password = "";

        private $decryption_key = "viraindo jaya";

        public $conn;
        public function getConnection(){
    
            $this->conn = null;

            $dbhost = decrypt($this->decryption_key, $this->host);
            $dbname = decrypt($this->decryption_key, $this->database_name);
            $dbusername = decrypt($this->decryption_key, $this->username);
            $dbpassword = decrypt($this->decryption_key, $this->password);            

            try{
                $this->conn = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbusername, $dbpassword);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>