<?php 

class Post{
    //db stuff
    private $conn;
    private $table = 'posts';

    //post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $create_at;

    //constructor with db connection
    public function __construct($db){
        $this -> conn = $db;

    }
    //getting posts from our datebase
        public function read(){
                //create query
                $query = 'SELECT
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.create_at
                FROM
                ' .$this -> table . ' p 
                LEFT JOIN
                    categories c ON p.categotry_id = c.id
                    ORDERED BY p.created DESC';
                //preapere statement
                $stmt = $this -> conn -> prepare($query);
                //execute query
                $stmt -> execute();

                return $stmt;
            }

        public function read_single(){
            $query = 'SELECT
            c.name as categpry_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
            FROM
            ' .$this ->table . 'p
            LEFT JOIN
                categories c ON p.cateogry_id = c.id
                WHERE p.id = ? LIMIT = 1';

                //prepare statement
            $stmt = $this -> conn -> prepare($query);
            //binding param
            $stmt -> bindParam(1, $this -> id); 
            //execute the query
            $stmt -> execute();
            $row = $stmt -> fetch(PDO::FETCH_ASSOC);

            $this -> title = $row['title'];
            $this -> body = $row['body'];
            $this -> author = $row['author'];
            $this -> category_id = $row['category_id'];
            $this -> category_name = $row['category_name'];


        }

        public function create(){
            //create query
            $query =  'INSERT INTO' . $this -> table . 'SET title =: title, body = :body, author = :author, category_id= :category_id';
            //preapare statement
            $stmt = $this -> conn -> preapare($query);
            //clean data
            $this -> title = htmlspecialchars(strip_tags($this -> title));
            $this -> body = htmlspecialchars(strip_tags($this -> body));
            $this -> author = htmlspecialchars(strip_tags($this -> author));
            $this -> category_id = htmlspecialchars(strip_tags($this -> category_id));
            //blinding of parameters
            $stmt -> blindParam(':title', $this -> title);
            $stmt -> blindParam(':body', $this -> body);
            $stmt -> blindParam(':author', $this -> author);
            $stmt -> blindParam(':category_id', $this -> category_id);
            //exectude the query
            if($stmt -> execute()){
                return true;
            }
            //printf error if something goes wrong
            printf("Errors %s. \n", $stmt -> error);
            return false;
        }

        //update post function
        public function update(){
            //create query
            $query =  'UPDATE' . $this -> table . '
            SET title =: title, body = :body, author = :author, category_id= :category_id
            WHERE id = :id';
            //preapare statement
            $stmt = $this -> conn -> preapare($query);
            //clean data
            $this -> title = htmlspecialchars(strip_tags($this -> title));
            $this -> body = htmlspecialchars(strip_tags($this -> body));
            $this -> author = htmlspecialchars(strip_tags($this -> author));
            $this -> category_id = htmlspecialchars(strip_tags($this -> category_id));
            $this -> id = htmlspecialchars(strip_tags($this -> id));
            //blinding of parameters
            $stmt -> blindParam(':title', $this -> title);
            $stmt -> blindParam(':body', $this -> body);
            $stmt -> blindParam(':author', $this -> author);
            $stmt -> blindParam(':category_id', $this -> category_id);
            $stmt -> blindParam(':id', $this -> id);
            //exectude the query
            if($stmt -> execute()){
                return true;
            }
            //printf error if something goes wrong
            printf("Errors %s. \n", $stmt -> error);
            return false;
        }

}

?>
