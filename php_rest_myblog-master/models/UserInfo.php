<?php
class UserInfo
{
    // DB stuff
    private $conn;
    private $table = 'UserInfo';

    // Properties
    public $id;
    public $username; 
    public $userpassword; 
    public $isposter; 
    public $isreader;
    public $isadmin;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function checkPassword()
    {
        $query = "SELECT user_password, is_poster, is_reader, is_admin FROM UserInfo where user_name = :username";
        $sth = $this->conn->prepare($query);
        echo "query";
        $sth->bindParam(":username", $this->username);
        echo "bind";
        if($sth->execute()){
            echo "execute";
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            echo $row;
            echo $row['user_password'];
            if(password_verify($this->userpassword, $row['user_password'])){
                echo "succ";
                $this->isposter = $row['is_poster'];
                $this->isreader = $row['is_reader'];
                $this->isadmin = $row['is_admin'];
                return true;
            }else{
                echo "false";
                return false;
            }
        }else{
            printf("Error: %s.\n", $sth->error);

            return false;
        }

        
        // Create query
       // $query = "SELECT body FROM SpeedData_UC_OH where id = 1";
        //$result = $conn->query($query);
       
    }

    
}
//echo password_hash("!GXb)72L", PASSWORD_DEFAULT);

// if(password_verify('!Gb)72L', $result)){

// }else{
//     echo "wrong";
// }