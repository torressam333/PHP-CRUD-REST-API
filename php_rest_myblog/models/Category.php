<?php
class Category{
    //DB Stuff
    private $conn;
    private $table = 'categories';
    
    //Properties
    public $id;
    public $name;
    public $created_at;

     //Constructor with DB
     public function __construct($db)
     { 
         $this->conn = $db;             
     }

     //Get categories
     public function read(){
        //Create Query
        $query = 'SELECT
        id,
        name,
        created_at
        FROM
        ' . $this->table . '
        ORDER BY
         created_at DESC';

         //Prepare Statement
         $stmt = $this->conn->prepare($query);

         //Execute Query
         $stmt->execute();

         return $stmt;
     }

  
//GET Single Category
    public function read_single(){
        //Create Query
        $query = 'SELECT id, name              
            FROM
                categories
            WHERE
                id = ?
                LIMIT 0,1';

        //Prepare Statement
        $stmt =  $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->id);

        //Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set Properties
        $this->id = $row['id'];
        $this->name = $row['name'];
    }

   
     //Create Category
     public function create(){
        //Create Query
        $query = 'INSERT INTO ' . 
            $this->table . 
        ' SET
            name = :name';

     //Prepare Statement
     $stmt =  $this->conn->prepare($query);

     //Sanitize Data
        $this->name = htmlspecialchars(strip_tags($this->name));

        //Bind Data
        $stmt->bindParam(':name', $this->name);

        //Execute Query
        if($stmt->execute())
        {   
            return true;
        }else{
            //Print error if something goes wrong
            print_f("Error: %s .\n", $stmt->error);
            return false;
        }
    }


//UPDATE Categories
public function update(){
    //Update Query
    $query = 'UPDATE ' . 
        $this->table . 
    ' SET
        name = :name  
    WHERE
        id = :id';

 //Prepare Statement
 $stmt =  $this->conn->prepare($query);

 //Sanitize Data
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->id = htmlspecialchars(strip_tags($this->id));

    //Bind Data
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':id', $this->id);

    //Execute Query
    if($stmt->execute())
    {   
        return true;
    }else{
        //Print error if something goes wrong
        print_f("Error: %s .\n", $stmt->error);
        return false;
    }
}


//DELTE POSTS
public function delete(){
    //Create Delete Query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id= :id';

    //Prepared Statement
     $stmt =  $this->conn->prepare($query);

     //Clean the ID
     $this->id = htmlspecialchars(strip_tags($this->id));

     //Bind the ID
     $stmt->bindParam(':id', $this->id);

    //Execute Query
       if($stmt->execute())
       {   
           return true;
       }else{
           //Print error if something goes wrong
           print_f("Error: %s .\n", $stmt->error);
           return false;
       }
}
}