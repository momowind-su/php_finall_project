<?php
    require_once("classes/Post.php");
    require_once("CommentModel.php");
    require_once("Model.php");


    /* post comment
    * singleton
    */
    class PostModel extends Model
    {
        
        protected static $class = "Post";

        /* create post model instance if needed
        * return instance of post model
        */
        public static function getInstance()
        {
            
            if(self::$instance == null)
                self::$instance = new PostModel();
        
            return self::$instance;
        
        }

        /* get all post with post creator full name
        * return array of post objects
        */
        public static function print_all_posts(): array
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

        /* get all posts as array of assoc arrays
        * return array of assoc arrays
        */
        public static function get_all_posts(): array
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

        /* find one post by post id with its comments
        * @param int post id
        * return array contains post and comment
        */
        public static function print_post(int $id): array
        {
            self::connect();
            $sql = "SELECT p.*, CONCAT(u.first_name, ' ', u.last_name) AS user_name ".
                "FROM posts AS p ".
                "LEFT JOIN users AS u ON u.user_id=p.user_id ".
                "WHERE post_id=:id";

            $statement = self::$connection->prepare($sql);
            $statement->execute([':id'=>$id]);
            $post = $statement->fetchObject(self::$class);
            self::disconnect();

            $comments = CommentModel::getCommentsByPostId($id);
            return ["post" => $post, "comments" => $comments];
        }

        /* post update by post id
        * @param string title
        * @param string text
        * @param int post_id
        * return number of affected rows
        */
        public static function edit_post(string $title, string $text, int $post_id): int
        {
            $data = [
                "title" => $title,
                "text" => $text,
                "post_id" => $post_id
            ];
    
            self::connect();
            $sql = "UPDATE posts SET title=:title, text=:text WHERE post_id=:post_id";
            $affected_rows = self::$connection->prepare($sql)->execute($data);
            self::disconnect();
            return $affected_rows;
        }

        /* create post with given params
        * @param string title
        * @param string text
        * return number of affected rows
        */
        public static function create_post(string $title, string $text): int
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
                $affected_rows = self::$connection->prepare($sql)->execute($data);
                self::disconnect();
                return $affected_rows;
            }
        }

        /* delete post by post id (all comments will also deleted)
        * @param int post id
        * return number of affected rows
        */
        public static function delete_post(int $post_id): int
        {
            self::connect();
            $sql = "DELETE FROM posts WHERE post_id=:post_id";
            $affected_rows = self::$connection->prepare($sql)->execute([":post_id"=>$post_id]);
            self::disconnect();
            return $affected_rows;
        }
    }
?>