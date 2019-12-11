<?php

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

    // read users with matching company_name and password
    public function read() {
        try {
            // if(isset($_POST['company_name']) && isset($_POST['password'])) {
                // $company_name = $_POST['company_name'];
                // $password = $_POST['password'];
            
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
                    "company_name" => $row->company_name
                    ]);
                    
                    $status = "OK";
                    }
                    $returnval=$listCompany;
                }
            } else {
            $status = "error 1";
        }
        //print_r($status);
       // $returnval = true;

        if($status != "OK") {
            $returnval = array("error");
        }
        
    } catch(PDOException $e) {
        print_r($e);
    }
    
    return json_encode($returnval);
    }

    // public function add_session() {
    //     $_SESSION["company_name"] = $this->find_user()["company_name"];
    //     $_SESSION["password"] = $this->find_user()["password"];
    //     if($this->find_user()["admin"] == true ){
    //         $_SESSION["user"] = "admin";
    //     } else{
    //         $_SESSION["user"] = "standard";
    //     }
    // }

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
