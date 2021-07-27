<?php


class Task{
    private $conn;
    private $table = 'tasks';

    public $id;
    public $category_id;
    public $user_id;
    public $title;
    public $description;
    public $date_time;
    public $done;
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
            date_time, 
            done, 
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
        $query = 'SELECT 
            id, 
            category_id, 
            user_id, 
            title, 
            description, 
            date_time, 
            done, 
            created_at 
        FROM '
            . $this->table .' 
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
        $this->category_id = $row['category_id'];
        $this->user_id = $row['user_id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->date_time = $row['date_time'];
        $this->done = $row['done'];
        $this->created_at = $row['created_at'];
    }

    public function create(){
        //Create query
        $query = 'INSERT INTO ' . 
                $this->table . '
            SET
                id = :id, 
                category_id = :category_id,
                user_id = :user_id,
                title = :title,
                description = :description,
                date_time = :date_time,
                done = :done';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->date_time = htmlspecialchars(strip_tags($this->date_time));
        $this->done = htmlspecialchars(strip_tags($this->done));


        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':date_time', $this->date_time);
        $stmt->bindParam(':done', $this->done);

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
                category_id = :category_id,
                user_id = :user_id,
                title = :title,
                description = :description,
                date_time = :date_time,
                done = :done
            WHERE 
                id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->date_time = htmlspecialchars(strip_tags($this->date_time));
        $this->done = htmlspecialchars(strip_tags($this->done));
        $this->id = htmlspecialchars(strip_tags($this->id));


        //Bind data
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':date_time', $this->date_time);
        $stmt->bindParam(':done', $this->done);
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