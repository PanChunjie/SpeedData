<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  //header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';
  $url = "http://api.openweathermap.org/data/2.5/weather?zip=45220,us&APPID=8ea80fceb1c77f7b6e101fd61bf5076c&mode=xml";
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get raw posted data
  //$data = json_decode(file_get_contents("php://input"));
  $data = file_get_contents($url);
  echo json_encode(
    array('message' => $data)
  );
  $post->body = $data;
  
  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }

