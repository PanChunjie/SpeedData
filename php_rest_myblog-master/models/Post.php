<?php
class Post
{
    // DB stuff
    private $conn;
    private $table = 'SpeedData_UC_OH';

    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function read()
    {
        // Create query
        try {
            $query = "SELECT body FROM $this->table";
            //$result = $conn->query($query);
            echo $query;
            $sth = $this->conn->prepare($query);
            if($sth == false){
              echo "prepare false";
            }
            $res = $sth->excute();
            if($res == false){
              echo "excute false";
            }
            $result = $res->fetchAll();
            print_r($result);
           // print_r($conn->query($query));
            //echo 'print';
           // foreach ($conn->query($query) as $row) {
            //    echo $row['body'];
           // }
           // echo 'foreach';
            // Prepare statement
            // $stmt = $this->conn->prepare($query);
            // Execute query
            //  $stmt->execute();
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $stmt;

    }

    // Get Single Post
    public function read_single()
    {
        // Create query
        $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      categories c ON p.category_id = c.id
                                    WHERE
                                      p.id = ?
                                    LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }

    // Create Post
    public function create()
    {
        $this->created_at = date('Y-m-d G:i:s');
        // Create query
        $query = "INSERT INTO $this->table(body, created_at) VALUES('$this->body' , '$this->created_at')";
        echo "query ". $query;
        $count = $this->conn->exec($query);
        echo "count ". $count;
        if($count == 0){
          return false;
        }else{
          echo "count ". $count;
          return true;
        }
        
        // Create query
       // $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';

        // Prepare statement
      //  $stmt = $this->conn->prepare($query);
     //   printf("stmt ". $stmt);

        // // Clean data
        // $this->title = htmlspecialchars(strip_tags($this->title));
        // $this->body = htmlspecialchars(strip_tags($this->body));
        // $this->author = htmlspecialchars(strip_tags($this->author));
        // $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // // Bind data
        // $stmt->bindParam(':title', $this->title);
        // $stmt->bindParam(':body', $this->body);
        // $stmt->bindParam(':author', $this->author);
        // $stmt->bindParam(':category_id', $this->category_id);

        // Execute query
     //   if ($stmt->execute()) {
       //   printf("true");
       //     return true;
      //  }

        // Print error if something goes wrong
      //  printf("Error: %s.\n", $stmt->error);

        //return true;
    }

    // Update Post
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET title = :title, body = :body, author = :author, category_id = :category_id
                                WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Post
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

}
