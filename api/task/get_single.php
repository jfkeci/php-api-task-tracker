<?php
 

//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Task.php');  

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

$task = new Task($db);

//Get id
$task->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get single task 
$task->get_single();

//Create array
$task_arr = array(
    'id' => $task->id,
    'category_id' => $task->category_id,
    'user_id' => $task->user_id,
    'title' => $task->title,
    'description' => $task->description,
    'date_time' => $task->date_time,
    'done' => $task->done,
    'created_at' => $task->created_at
);

print_r(json_encode($task_arr));

?>