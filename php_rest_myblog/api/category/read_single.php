<?php
//Interact with HTTP
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Post Object
$cat = new Category($db);

//Get ID from URL
$cat->id = isset($_GET['id']) ? $_GET['id'] : die('Request Failed');

//Get Post
$cat->read_single();

//Creae array
$cat_arr = array(
    'id' => $cat->id,
    'name' => $cat->name,
);

//Convert to JSON Data
print_r(json_encode($cat_arr));