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
            
        $sql = ("SELECT * FROM posts");
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

        public static function print_post($id)
        {
            self::connect();
            $statement = self::$connection->prepare("SELECT * FROM posts WHERE post_id = :id");
            $statement->execute([':id'=>$id]);
            $result = $statement->fetchObject(self::$class);
            self::disconnect();
            return $result;
        }



    }
?>