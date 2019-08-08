<?php
class user
{
    // DB stuff
    private $conn;
    private $table = 'user';

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
        $query = "SELECT userpassword, isposter, isreader, isadmin FROM user where username = ?";
        $sth = $this->conn->prepare($query);
        echo "query";
        $stmt->bindParam(1, $this->username);
        echo "bind";
        $sth->execute();
        echo "execute";
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $row;
        if(password_verify($this->userpassword, $row['userpassword'])){
            
            $this->isposter = $row['isposter'];
            $this->isreader = $row['isreader'];
            $this->isadmin = $row['isadmin'];
            return true;
        }else{
            return false;
        }
        
        // Create query
       // $query = "SELECT body FROM SpeedData_UC_OH where id = 1";
        //$result = $conn->query($query);
        
        $sth = $this->conn->prepare($query);
        // $sth->bindParam(1, $this->table);
        $sth->execute();
            // $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $sth;
    }

    
}
echo password_hash("!GXb)72L", PASSWORD_DEFAULT);

// if(password_verify('!Gb)72L', $result)){

// }else{
//     echo "wrong";
// }