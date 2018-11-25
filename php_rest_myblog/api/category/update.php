<?php

//Interact with HTTP
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type
        Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Post Object
$cat = new Category($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set ID to update
$cat->id = $data->id;


$cat->name = $data->name;

//Update Post
if($cat->update()){
    echo json_encode(
        array('message' => 'Category Updated')
    );
}else{
    echo json_encode(
        array('message' => 'Category Not Updated')
    );
}