<?php

//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Category.php');

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

//set ID
$category->id = $data->id;

//Delete the category
if($category->delete()){
    echo json_encode(
        array('message' => 'Category Deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Category Deleted')
    );
}



?>