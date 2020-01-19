<?php
session_start();

class User {

    // db connection and table name
    private $conn;
    private $table_name1 = "user";

    // other user properties
    public $id;
    public $company_name;
    public $password;
    public $errors = [];

    // pdo connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Unused function that available for use later by admin: returns everything from database with out matching company name to password
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name1;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    
    // read users with matching company_name and password
    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table_name1 .
            " WHERE company_name LIKE :company_name AND password = :password";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute(
            [
                ":company_name" => $this->company_name,
                ":password" => $this->password
            ]
            )) { 
                if($stmt->rowCount() > 0) {        
                    $listCompany = [];                    
                    while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($listCompany, [
                        "company_name" => $row->company_name,
                        "id" => $row->id,
                        "admin" => $row->admin
                    ]);                    
                    $status = "OK";
                    }
                    $returnval=$listCompany;
                }
            } else {
            $status = "error 1";
        }
        if($status != "OK") {
            $returnval = array("Oops! Please enter a correct company name or password!");
        }    
    } catch(PDOException $e) {
        print_r($e);
    }
    return json_encode($returnval);
    }

    // // Set session
    public function add_session() {
        $_SESSION["company_name"] = $this->read()["company_name"];
        $_SESSION["password"] = $this->read()["password"];
        if($this->read()["admin"] == true ){
            $_SESSION["user"] = "admin";
        } else{
            $_SESSION["user"] = "standard";
        }
    }

    // Unused function but available for Admin use later: create users
    public function create() {
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

    // Unused function but available for Admin use later: update user
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

    // Unused function but available for use in Admin in the future: delete user
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
