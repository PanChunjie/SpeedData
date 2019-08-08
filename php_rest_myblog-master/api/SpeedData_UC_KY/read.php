<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET');
  include_once '../../config/Database.php';
  include_once '../../models/SpeedData_UC_KY.php';
 
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new SpeedData_UC_KY($db);
  print_r( "First");
  // Blog post query
  $result = $post->read();
  print_r( "read");
  // Get row count
  $num = $result->rowCount();
  
  print_r( $num);
   // // Check if any posts
   if($num > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
    print_r(htmlspecialchars_decode( $row[body]));
    

   } else {
  //   // No Posts
   echo json_encode(
      array('message' => 'Posts Not Found')
    );
   } 
