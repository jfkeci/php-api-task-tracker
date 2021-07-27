<?php

//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Task.php');

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

$task = new Task($db);

$data = json_decode(file_get_contents("php://input"));

//set ID
$task->id = $data->id;

//Delete the task
if($task->delete()){
    echo json_encode(
        array('message' => 'Task Deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Task Deleted')
    );
}



?>