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
            $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        }
}

?>
