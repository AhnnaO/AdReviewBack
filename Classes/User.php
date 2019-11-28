<?php

class User {

    // db connection and table name
    private $conn;
    private $table_name1 = "user";

    // other user properties
    public $company_name;
    public $password;

    public $errors = [];

    // pdo connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read users
    public function read() {
        $query = "SELECT * FROM " . $this->table_name1;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // create users
    function create() {
        try {
            $query = "INSERT INTO "
             . $this->table_name1 . 
             "(company_name, password) VALUES 
             (:company_name, :password)";
            $stmt = $this->conn->prepare($query);
            
            // sanitize
            $this->company_name=htmlspecialchars(strip_tags($this->company_name));
            $this->password=htmlspecialchars(strip_tags($this->password));

            $args = array(
                'company_name' => $this->company_name,
                'password' => $this->password
            );

            if($stmt->execute($args)) {
                $status = "OK";
            }else{
                $status = "error 1";
            }
            print_r($status);
            $returnval = true;

            if($status != "OK") {
                $returnval = false;
            }

            return $returnval;
        }catch(PDOException $e) {
            print_r($e);
        }
    }

    // update user
    function update() {
        try {
            $query = "UPDATE "
            . $this->table_name .
            "SET company_name=:company_name, password=:password";
        
            $stmt = $this->conn->prepare($query);

            // sanitize
            $this->company_name=htmlspecialchars(strip_tags($this->company_name));
            $this->password=htmlspecialchars(strip_tags($this->password));
        
            // bind new values
            $stmt->bindParam(":company_name", $this->company_name);
            $stmt->bindParam(":password", $this->password);

            if($stmt->execute()) {
                $status = "OK";
            }else{
                $status = "error 1";
            }
            print_r($status);
            $returnval = true;

            if($status != "OK") {
                $returnval = false;
            }
            return $returnval;
        }
        catch(PDOException $e) {
            print_r($e);
        }
    }
    
    function delete() {
        try {
            $query = "DELETE FROM "
            . $this->table_name1 .
            " WHERE id = ?";

            $stmt = $this->conn->prepare($query);

            // Sanitize
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind id of record to delete
            $stmt->bindParam(1, $this->id);

            if($stmt->execute()) {
                $status = "OK";
            }else{
                $status = "error 1";
            }
            print_r($status);
            $returnval = true;
    
            if($status != "OK") {
                $returnval = false;
            }
            return $returnval;
        }
        catch(PDOException $e) {
            print_r($e);
        }     
    }
}

?>
