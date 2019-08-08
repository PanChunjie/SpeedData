<?php
// Headers
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/SpeedData_UC_KY.php';
include_once '../../models/UserInfo.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate user object
$user = new UserInfo($db);

//Get raw data
$data = json_decode(file_get_contents("php://input"));
//echo $data;
$user->username = $data->username;
$user->userpassword = $data->password;
//$user->username = 'admin';
//$user->userpassword = '!GXb)72L';

//authentication
if ($user->checkPassword()) {   
    if ($user->isposter || $user->isadmin) {
        $post = new SpeedData_UC_KY($db);
        $post->body = $data->xml;
        //$post->body = 'This is a default xml';
        $result = $post->update();
        $rownum = $result->rowCount();
        // Update post
        if ($rownum == 0) {
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
    }else{
      echo "You don't have permission to update data;";
    }
} 


