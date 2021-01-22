<?php
    require_once("models/PostModel.php");
    class PostController
    {
        public function __construct(){
            $this->post = PostModel::getInstance();
        }

        public function posts_page()
        {
            $posts = $this->post::print_all_posts();
            require_once("views/posts.php");
        }
        public function post_page()
        {
           
            if(isset($_POST['id']) && is_numeric($_POST['id']))
            {
                $post = $this->post::print_post($_POST['id']);
                require_once("views/post.php");
            }
            else
                require_once("404.html");       
        }

    }
    
?>