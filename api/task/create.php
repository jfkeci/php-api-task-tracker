<?php

//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Task.php');

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

$task = new Task($db);

$data = json_decode(file_get_contents("php://input"));

$task->id = $data->user_id . round(microtime(true) * 1000);
$task->category_id = $data->category_id;
$task->user_id = $data->user_id;
$task->title = $data->title;
$task->description = $data->description;
$task->date_time = $data->date_time;
$task->done = $data->done;


//Create the task
if($task->create()){
    echo json_encode(
        array('message' => 'Task created')
    );
}else{
    echo json_encode(
        array('message' => 'Task not created')
    );
}

?>