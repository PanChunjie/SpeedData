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
  $result = $post->update();
  $rownum = $result->rowCount();
  // Update post
  if($rownum == 0) {
    echo "SpeedData_UC_KY doesn't have data at id=1, try to use create api";
    // echo json_encode(
    //   array('message' => 'SpeedData_UC_KY Not Updated')
    // );
  } else {
    echo 'SpeedData_UC_KY Updated';
    // echo json_encode(
    //   array('message' => 'SpeedData_UC_KY Updated')
    // );
  } 

