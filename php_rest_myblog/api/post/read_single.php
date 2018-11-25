<?php
//Interact with HTTP
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';


//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Post Object
$post = new Post($db);

//Get ID from URL
$post->id = isset($_GET['id']) ? $_GET['id'] : die('Request Failed');

//Get Post
$post->read_single();

//Creae array
$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
);

//Convert to JSON Data
print_r(json_encode($post_arr));