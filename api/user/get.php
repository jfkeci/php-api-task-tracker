<?php

//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/User.php');


//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiating User class
$user = new User($db);

//Blog user query
$result = $user->get();

//Get row count
$num = $result->rowCount();

//Check if any users
if($num > 0){
    //users arrays
    $users_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $user_item = array(
            'id' => $id,
            'first_name' => $first_name,
            'last_name' => html_entity_decode($last_name),
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'created_at' => $created_at
        );

        //Push to 'data'
        array_push($users_arr, $user_item);

    }

     //Turn to JSON and output
     echo json_encode($users_arr);

}else{
    echo json_encode(array('message' => 'no users found'));
}




?>