<?php

//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Category.php');


//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiating category class
$category = new Category($db);

//Blog category query
$result = $category->get();

//Get row count
$num = $result->rowCount();

//Check if any categorys
if($num > 0){
    //categories arrays
    $categories_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $category_item = array(
            'id' => $id,
            'name' => $name,
            'created_at' => $created_at
        );

        //Push to 'data'
        array_push($categories_arr, $category_item);

    }

     //Turn to JSON and output
     echo json_encode($categories_arr);

}else{
    echo json_encode(array('message' => 'no categories found'));
}




?>