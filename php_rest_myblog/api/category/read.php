<?php
//CATEGORY READ

//Interact with HTTP
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Category Post Object
$category = new Category($db);

//Call Read Function from Category Class
$result = $category->read();

//Get row count
$num = $result->rowCount();

//Check if any categories
if($num > 0){
    //Categories Array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $cat_item = array(
            'id' => $id,
            'name' => $name,
        );

        //Push to 'data'
        array_push($cat_arr['data'], $cat_item);
    }

    //Turn to JSON & output data
    echo json_encode($cat_arr);
}else{
    //No Category error
    echo json_encode(
        array('message' => 'No Categories Found.')
    );
}