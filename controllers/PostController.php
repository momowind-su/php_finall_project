<?php
    require_once("models/PostModel.php");
    require_once("interfaces/Downloadable.php");
    require_once("traits/MakeCsv.php");

    class PostController implements Downloadable
    {
        use MakeCsv;

        public function __construct(){
            $this->model = PostModel::getInstance();
            $this->auth = Auth::getInstance();
        }

        public function posts_page()
        {
            $title = 'Posts';
            $posts = $this->model::print_all_posts();
            require_once("views/posts.php");
        }

        public function post_page()
        {
            if(isset($_POST['id']) && is_numeric($_POST['id']))
            {
                $title = 'Post';
                $post = $this->model::print_post($_POST['id']);
                require_once("views/post.php");
            }
            else
                require_once("404.html");
        }

        public function show_posts()
        {
            $title = 'All posts';
            $posts = $this->model::print_all_posts();
            require_once("views/posts_dashboard.php");
        }

        public function update_post()
        {
            if(isset($_POST['id']) && is_numeric($_POST['id']))
            {
                $title = 'Update post';
                $post = $this->model::print_post($_POST['id']);
                require_once('views/update_post.php');
            }
        }

        public function do_update()
        {
            if(isset($_POST['title']) && isset($_POST['title']) && isset($_POST['post_id']) && is_numeric($_POST['post_id']))
            {
                $this->model::edit_post($_POST['title'], $_POST['text'], $_POST['post_id']);
            }
            header('Location: /?m=post&a=show_posts');
        }

        public function create_post()
        {
            $title = "New post";
            require_once("views/create_post.php");
        }

        public function do_create()
        {
            if(isset($_POST['title']) && isset($_POST['text']) &&
                !empty($_POST['title']) && !empty($_POST['text']))
            {
                $this->model::create_post($_POST['title'], $_POST['text']);
            }
            header('Location: /?m=post&a=show_posts');
        }

        public function delete_post()
        {
            if(isset($_POST['id']) && is_numeric($_POST['id']))
            {
                $this->model::delete_post($_POST['id']);
            }
            header('Location: /?m=post&a=show_posts');

        }

        public function download_posts()
        {
            $filename = "posts_".date("_Ymdis").".csv";
            $columns = [
                "post_id" => "Post ID",
                "user_name" => "User name",
                "title" => "Title",
                "text" => "Text",
                "created_at" => "Created at",
                "updated_at" => "Updated at",
            ];

            $posts = $this->model::get_all_posts();
            $this->download($filename, $columns, $posts);
        }
    }

?>