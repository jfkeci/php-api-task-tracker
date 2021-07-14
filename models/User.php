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
            id = :? ;';
    }

    public function create(){

    }
    
    public function update(){

    }

    public function delete(){

    }


}

?>