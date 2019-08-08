<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET');

  include_once '../../config/Database.php';
  include_once '../../models/SpeedData_UC_OH.php';
 
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Blog post query
  $result = $post->read();
  // Get row count
  $num = $result->rowCount();
  

   // // Check if any posts
   if($num > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
    //print_r(htmlspecialchars_decode( $row[body]));
    $xml = new SimpleXMLElement($row[body]);

    echo $xml->asXML();

   } else {
  //   // No Posts
   echo json_encode(
      array('message' => 'Posts Not Found')
    );
   } 