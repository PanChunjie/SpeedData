<?php
class SpeedData_UC_KY
{
    // DB stuff
    private $conn;
    private $table = 'SpeedData_UC_KY';

    // Post Properties
    public $id;
    public $body; 
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
        $query = "SELECT body FROM SpeedData_UC_KY where id = 1";
        //$result = $conn->query($query);
        print_r( "query");
        $sth = $this->conn->prepare($query);
        print_r( "prepare");
        // $sth->bindParam(1, $this->table);
        $sth->execute();
            // $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $sth;
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
        $this->id = 1;
        // Create query
        $this->body = htmlspecialchars($this->body);      
        $this->id = htmlspecialchars($this->id);
        $query = "INSERT INTO $this->table(id, body, created_at) VALUES($this->id, '$this->body' , '$this->created_at')";
        echo "query " . $query;
        $count = $this->conn->exec($query);
        echo "count " . $count;
        if ($count == 0) {
            
            return false;
        } else {
            print("Insert $count rows.\n");
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
        $this->created_at = date('Y-m-d G:i:s');
        $this->id = 1;
        // Create query
        $query = 'UPDATE ' . $this->table . '
                                SET body = :body, created_at = :created_at
                                WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
       
        $this->body = htmlspecialchars($this->body);      
        $this->id = htmlspecialchars($this->id);

        // Bind data
      
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':created_at', $this->created_at);
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
