<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  echo json_encode(
    array('message' => 'Posts Found')
  );
 // include_once '../../config/Database.php';
 // include_once '../../models/Post.php';
  
  //  $html = "";
    $xmlstr = simplexml_load_file("http://api.openweathermap.org/data/2.5/weather?zip=45220,us&APPID=8ea80fceb1c77f7b6e101fd61bf5076c&mode=xml");

  //  $xmlobj = new SimpleXMLElement($xmlstr);
  //  $xmlobj = (array)$xmlobj;//optional
   // $xml = simplexml_load_file($url);
    print_r($xmlstr);
  
  // print_r('asda');
  
 // echo $url;
  // Instantiate DB & connect
 // $database = new Database();
 // $db = $database->connect();

  // Instantiate blog post object
 // $post = new Post($db);

  // Blog post query
 // $result = $post->read();
  // Get row count
   $num = 5;

   // // Check if any posts
   if($num > 0) {
  //   // Post array
  //   $posts_arr = array();
  //   // $posts_arr['data'] = array();

  //   // while($row = $result->fetch(PDO::FETCH_ASSOC)) {
  //   //   extract($row);

  //   //   $post_item = array(
  //   //     'id' => $id,
  //   //     'title' => $title,
  //   //     'body' => html_entity_decode($body),
  //   //     'author' => $author,
  //   //     'category_id' => $category_id,
  //   //     'category_name' => $category_name
  //   //   );

  //   //   // Push to "data"
  //   //   array_push($posts_arr, $post_item);
  //   //   // array_push($posts_arr['data'], $post_item);
  //   // }

  //   // Turn to JSON & output
    echo json_encode(
     array('message' => 'Posts Found')
    );

   } else {
  //   // No Posts
   echo json_encode(
      array('message' => 'Posts Not Found')
    );
   } 
