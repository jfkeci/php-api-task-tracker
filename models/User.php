<?php

class User{

    private $conn;
    private $table = 'users';

    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;   
    }

    public function get(){

        $query = 'SELECT 
            id, 
            first_name, 
            last_name, 
            username, 
            email, 
            password, 
            created_at 
        FROM 
            '. $this->table .' 
        ORDER BY 
            created_at 
        DESC; ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function get_single(){
        $query = 'SELECT 
            id, 
            first_name, 
            last_name, 
            username, 
            email, 
            password, 
            created_at 
        FROM 
            '. $this->table .'  
        WHERE  
            id = ? ;';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind id
        $stmt->bindParam(1, $this->id);

        //Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set the properties
        $this->id = $row['id'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->created_at = $row['created_at'];
    }

    public function create(){
        //Create query
        $query = 'INSERT INTO ' . 
                $this->table . '
            SET
                first_name = :first_name,
                last_name = :last_name,
                username = :username,
                email = :email,
                password = :password';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        //Bind data
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        //execute query
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n,$stmt->error");
        return false;
    }
    
    public function update(){
        //Create query
        $query = 'UPDATE ' . 
                $this->table . '
            SET
                first_name = :first_name,
                last_name = :last_name,
                username = :username,
                email = :email,
                password = :password
            WHERE
                id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':id', $this->id);

        //execute query
        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n,$stmt->error");
        return false;
    }

    public function delete(){

        //Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Cleaning the id
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Binding the id
        $stmt->bindParam(':id', $this->id);

        //execute query
        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n, $stmt->error");
        return false;

    }


}

?>