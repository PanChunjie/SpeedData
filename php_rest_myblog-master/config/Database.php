<?php 
  class Database {
    // DB Params
    private $host = 'ec2-174-129-226-232.compute-1.amazonaws.com';
    private $db_name = 'd7ken1r1teta2e';
    private $username = 'smjvlbeupqpqtc';
    private $password = '111f398800f92d0708dabfe7603f8c44da14311fb6eb861e1a0b41f6febdc2a2';
    private $port = "5432";
    private $conn;

    // DB Connect
    public function connect() {
      // $this->conn = null;
      if($this->conn == null || $this->conn->connection_status() != 0){
        $this->conn = null;        
        try { 
          $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";user=" . $this->username . ";password =" . $this->password . ";";
          $this->conn = new PDO($dsn, $this->username, $this->password);
          $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          print_r("database connected 1");
          print_r($this->conn->connection_status());
        } catch(PDOException $e) {
          echo 'Connection Error: ' . $e->getMessage();
        }
      }else{
        print_r("database not connected");
      }
      

      return $this->conn;
    }
  }

  