<?php

//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Task.php');


//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiating Task class
$task = new Task($db);

//Blog task query
$result = $task->get();

//Get row count
$num = $result->rowCount();

//Check if any tasks
if($num > 0){
    //tasks arrays
    $tasks_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $task_item = array(
            'id' => $id,
            'category_id' => $category_id,
            'user_id' => $user_id,
            'title' => $title,
            'description' => $description,
            'date_time' => $date_time,
            'done' => $done,
            'created_at' => $created_at,
        );

        //Push to 'data'
        array_push($tasks_arr, $task_item);

    }

     //Turn to JSON and output
     echo json_encode($tasks_arr);

}else{
    echo json_encode(array('message' => 'no tasks found'));
}




?>