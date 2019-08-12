<?php
// Headers
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json');
header('Content-type: text/xml'); //return type
header('Content-Disposition: attachment;filename="SpeedData_UC_OH.xml"');
header('Access-Control-Allow-Methods: GET');
//header('Pragma: Public');
include_once '../../config/Database.php';
include_once '../../models/SpeedData_UC_OH.php';

// Instantiate user object
$user = new UserInfo($db);
//echo $data;
$user->username = $_GET['username'];
$user->userpassword = $_GET['password'];

if ($user->checkPassword()) {
    if ($user->isposter || $user->isadmin || $user->isreader) {
        // Instantiate DB & connect
        $database = new Database();
        $db = $database->connect();

        // Instantiate blog post object
        $post = new SpeedData_UC_OH($db);

        //post query
        $result = $post->read();

        // Get row count
        $num = $result->rowCount();

        // // Check if any posts
        if ($num > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo htmlspecialchars_decode($row[body]);

        } else {
            //   // No Posts
            echo "Data not found;";
        }
    } else {
      echo "You don't have permission to read data;";
    }

}else{
  echo "Your username and password don't match;";;
}
