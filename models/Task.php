<?php


class Task{
    private $conn;
    private $table = 'tasks';

    public $id;
    public $category_id;
    public $user_id;
    public $title;
    public $description;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get(){
        $query = 'SELECT 
            id, 
            category_id, 
            user_id, 
            title, 
            description, 
            created_at 
        FROM '
            . $this->table .' 
        ORDER BY 
            created_at 
        DESC;';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function get_single(){

    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }

}

?>