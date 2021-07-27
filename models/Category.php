<?php

class Category{

    private $conn;
    private $table = 'categories';

    public $id;
    public $name;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get(){
        $query = 'SELECT id, name, created_at FROM '. $this->table . ' ORDER BY created_at DESC;';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function get_single(){
        $query = 'SELECT 
            id, 
            name, 
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
        $this->name = $row['name'];
        $this->created_at = $row['created_at'];
    }

    public function create(){
        //Create query
        $query = 'INSERT INTO ' . 
                $this->table . '
            SET
                name = :name';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        //Bind data
        $stmt->bindParam(':name', $this->name);

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
                name = :name
            WHERE
                id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(':name', $this->name);
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