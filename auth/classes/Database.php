<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/viraindo/function.php';

class Database{
    
    // CHANGE THE DB INFO ACCORDING TO YOUR DATABASE
    // private $db_host = 'localhost';
    // private $db_name = 'viraindo_demo';
    // private $db_username = 'root';
    // private $db_password = '';

    private $host = "QZdlXucJJGtO";
    private $database_name = "RskwB7tYeSplTkgsShUAsJ4=";
    private $username = "W5F0XuIPL3c=";
    private $password = "Do43Tb9QJXwK";
    private $decryption_key = "viraindo jaya";
    
    public function dbConnection(){
        
        $dbhost = decrypt($this->decryption_key, $this->host);
        $dbname = decrypt($this->decryption_key, $this->database_name);
        $dbusername = decrypt($this->decryption_key, $this->username);
        $dbpassword = decrypt($this->decryption_key, $this->password);    

        try{
            $conn = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e){
            echo "Connection error ".$e->getMessage(); 
            exit;
        }
          
    }
}