<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
 // header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

 include_once '../../config/Database.php';
 include_once '../../models/SpeedData_UC_KY.php';

  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new SpeedData_UC_KY($db);

  // Get raw posted data
  $data = trim(file_get_contents('php://input'));
  // Set ID to update
 // $post->id = $data->id;
  $post->body = $data;

  // Update post
  if($post->update()) {
    echo json_encode(
      array('message' => 'SpeedData_UC_KY Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'SpeedData_UC_KY Not Updated')
    );
  } 

