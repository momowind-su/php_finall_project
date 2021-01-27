<?php
    require_once("classes/Post.php");
    require_once("Model.php");


    class PostModel extends Model
    {
        
        protected static $class = "Post";

        public static function getInstance()
        {
            
            if(self::$instance == null)
                self::$instance = new PostModel();
        
            return self::$instance;
        
        }
        

        public static function print_all_posts()
        {
            $sql = "SELECT p.*, CONCAT(u.first_name, ' ', u.last_name) AS user_name ".
                    "FROM posts AS p ".
                    "LEFT JOIN users AS u ON u.user_id=p.user_id";
            self::connect();
            $resultArray = array();
            $result = self::$connection->query($sql);

            while($row = $result->fetchObject(self::$class))
            {
                $resultArray[] = $row;
            }
            
            self::disconnect();
            return $resultArray;
        }


        public static function get_all_posts()
        {
            $sql = "SELECT p.*, CONCAT(u.first_name, ' ', u.last_name) AS user_name ".
                    "FROM posts AS p ".
                    "LEFT JOIN users AS u ON u.user_id=p.user_id";
                    
            self::connect();
            $result = self::$connection->query($sql);
            $resultArray = $result->fetchAll();
            self::disconnect();
            return $resultArray;
        }

        public static function print_post($id)
        {
            self::connect();
            $sql = "SELECT p.*, CONCAT(u.first_name, ' ', u.last_name) AS user_name ".
                    "FROM posts AS p ".
                    "LEFT JOIN users AS u ON u.user_id=p.user_id ".
                    "WHERE post_id = :id";
            $statement = self::$connection->prepare($sql);
            $statement->execute([':id'=>$id]);
            $result = $statement->fetchObject(self::$class);
            self::disconnect();
            return $result;
        }

        public static function edit_post($title, $text, $post_id)
        {
            $data = [
                "title" => $title,
                "text" => $text,
                "post_id" => $post_id
            ];
    
            self::connect();
            $sql = "UPDATE posts SET title=:title, text=:text WHERE post_id=:post_id";
            $insert_id = self::$connection->prepare($sql)->execute($data);
            self::disconnect();
            return $insert_id;
        }

        // $this->model::create_post($_POST['title'], $_POST['text']);
        public static function create_post($title, $text)
        {
            if(isset($_SESSION['user']))
            {
                $data = [
                    "title" => $title,
                    "text" => $text,
                    "user_id" => $_SESSION['user']->get_user_id()
                ];
        
                self::connect();
                
                $sql = "INSERT INTO posts (title, text, user_id) VALUES (:title, :text, :user_id)";
                $insert_id = self::$connection->prepare($sql)->execute($data);
                self::disconnect();
                return $insert_id;
            }
        }

        public static function delete_post($post_id)
        {
            self::connect();
            $sql = "DELETE FROM  posts WHERE post_id=:post_id";
            $insert_id = self::$connection->prepare($sql)->execute([":post_id"=>$post_id]);
            self::disconnect();
            return $insert_id;
        }


    }
?>