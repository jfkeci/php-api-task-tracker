<?php
 

//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/User.php');  

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

$user = new User($db);

//Get id
$user->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get single user 
$user->get_single();

//Create array
$user_arr = array(
    'id' => $user->id,
    'first_name' => $user->first_name,
    'last_name' => $user->last_name,
    'username' => $user->username,
    'email' => $user->email,
    'password' => $user->password,
    'created_at' => $user->created_at
);

print_r(json_encode($user_arr));

?>