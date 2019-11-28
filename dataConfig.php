<?php

class Database{

    private $database_host = 'localhost';
    private $database_name = 'ad_review';
    // private $database_username = 'isobar';
    // private $database_password = 'wYkq1rZ5r8NnzNHW';
    private $database_username = 'root';
    private $database_password = 'root';
    
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        try{
            $this->conn = new PDO("mysql:host=" . $this->database_host . ";dbname=" . $this->database_name, $this->database_username, $this->database_password);
            $this->conn->exec('set names utf8');    
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        // check session 
        // check valid login
        // if not admin or super user (if standard use standard login user, if admin use admin login)
        // run try-catch again with different username and password

        return     
            $this->conn;
    }
    
}

?>