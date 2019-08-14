<?php 
  class Database {
    // DB Params
    private $conn;

    // DB Connect
    public function connect() {
        $this->conn = null;
        $config = parse_ini_file('../../../private/config.ini'); 
        try { 
        //  $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";user=" . $this->username . ";password =" . $this->password . ";";
        //  $this->conn = new PDO($dsn, $this->username, $this->password);
          $this->conn = new PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $config['hostname'],
            $config['port'],
            $config['username'],
            $config['password'],
            $config['dbname']
        ));
         // $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
        } catch(PDOException $e) {
          echo 'Connection Error: ' . $e->getMessage();
        }    
      return $this->conn;
    }
  }
