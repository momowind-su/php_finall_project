<?php
    require_once("models/PostModel.php");
    require_once("models/CommentModel.php");
    require_once("interfaces/Downloadable.php");
    require_once("traits/MakeCsv.php");

    /* 
    * comment controller
    * all ids passed in methods passed via POST
    */
    class PostController implements Downloadable
    {
        use MakeCsv;

        /* get instance of post model and auth class
        * @param 
        * return 
        */
        public function __construct()
        {
            $this->Post = PostModel::getInstance();
            $this->Auth = Auth::getInstance();
        }

        /* show all posts page
        * return void
        */
        public function posts_page(): void
        {
            $title = 'Posts';
            $posts = $this->Post::print_all_posts();
            require_once("views/posts.php");
        }

        /* show post page with its comments
        * return void;
        */
        public function post_page()
        {
            if(isset($_POST['id']) && is_numeric($_POST['id']))
            {
                $title = 'Post';
                $result = $this->Post::print_post($_POST['id']);
                $post = $result['post'];
                $comments = $result['comments'];
                require_once("views/post.php");
            }
            else
                require_once("404.html");
        }

        /* show dashboard posts page
        * return void
        */
        public function show_posts()
        {
            $title = 'All posts';
            $posts = $this->Post::print_all_posts();
            $user_role = $_SESSION['role'] ?? '';

            foreach($posts as &$post){
                $comments = CommentModel::getCommentsByPostId($post->get_post_id());
                $post->set_comments($comments);
            }

            require_once("views/posts_dashboard.php");
        }

        /* update post 
        * return void
        */
        public function update_post()
        {
            $this->Auth::has_permission(['admin','user']);

            if(isset($_POST['id']) && is_numeric($_POST['id']))
            {
                $title = 'Update post';
                $result = $this->Post::print_post($_POST['id']);
                $post = $result['post'];
                require_once('views/update_post.php');
            }
        }

        /* do post update with given data
        * return void
        */
        public function do_update()
        {
            $this->Auth::has_permission(['admin','user']);

            if(isset($_POST['title']) && isset($_POST['title']) && isset($_POST['post_id']) && is_numeric($_POST['post_id']))
            {
                $this->Post::edit_post($_POST['title'], $_POST['text'], $_POST['post_id']);
            }
            header('Location: /?m=post&a=show_posts');
        }

        /* show create post page
        * return void
        */
        public function create_post()
        {
            $this->Auth::has_permission(['admin','user']);

            $title = "New post";
            require_once("views/create_post.php");
        }

        /* do create new post
        * return void
        */
        public function do_create()
        {
            $this->Auth::has_permission(['admin','user']);

            if(isset($_POST['title']) && isset($_POST['text']) &&
                !empty($_POST['title']) && !empty($_POST['text']))
            {
                $this->Post::create_post($_POST['title'], $_POST['text']);
            }
            header('Location: /?m=post&a=show_posts');
        }

        /* delete post by id
        * return void
        */
        public function delete_post()
        {
            $this->Auth::has_permission(['admin','user']);

            if(isset($_POST['id']) && is_numeric($_POST['id']))
            {
                $this->Post::delete_post($_POST['id']);
            }
            header('Location: /?m=post&a=show_posts');

        }

        /* download all posts in csv format
        * return void
        */
        public function download_posts()
        {
            $this->Auth::has_permission(['admin']);

            $filename = "posts_".date("_Ymdis").".csv";
            $columns = [
                "post_id" => "Post ID",
                "user_name" => "User name",
                "title" => "Title",
                "text" => "Text",
                "created_at" => "Created at",
                "updated_at" => "Updated at",
            ];

            $posts = $this->Post::get_all_posts();
            $this->download($filename, $columns, $posts);
        }
    }

?>