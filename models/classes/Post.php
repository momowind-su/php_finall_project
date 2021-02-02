<?php
require_once("Comment.php");

    Class Post
    {
        private $user_id;
        private $title;
        private $text;
        private $image;
        private $updated_at;
        private $created_at;
        private $post_id;
        private $user_name;
        private $comments;

        /* build form with action going to post page
        * return form html string
        */
        public function link_to_post()
        {
            return "<form method='POST' action='?m=post&a=post_page'>"
                        ."<input type='hidden' name='id' value='".($this->get_post_id())."'>"
                        ."<button class='btn btn-primary'>Read more</button>"
                    ."</form>";
        }

        /* build form with action going to update post page
        * return form html string
        */
        public function link_to_update()
        {
            return "<form method='POST' action='?m=post&a=update_post'>"
                        ."<input type='hidden' name='id' value='".($this->get_post_id())."'>"
                        ."<button class='btn btn-success'>Update</button>"
                    ."</form>";
        }

        /* build form with action going to delete post page
        * return form html string
        */
        public function link_to_delete()
        {
            return "<form method='POST' action='?m=post&a=delete_post'>"
                        ."<input type='hidden' name='id' value='".($this->get_post_id())."'>"
                        ."<button class='btn btn-danger'>Delete</button>"
                    ."</form>";
        }

        /* get comments
        * return array of comment objects
        */
        public function get_comments(){
            return $this->comments;
        }

        /* get user id
        * return int user id
        */
        public function get_user_id()
        {
            return $this->user_id;
        }

        /* get title
        * return string title
        */
        public function get_title()
        {
            return $this->title;
        }

        /* get text
        * return string text
        */
        public function get_text()
        {
            return $this->text;
        }

        /* get short text
        * return string shorten text
        */
        public function get_short_text()
        {
            return substr($this->text,0, 100) . '...';
        }

        /*get updated at
        * return string formatted updated at
        */
        public function get_updated_at()
        {
            return date_format(date_create($this->updated_at), "d/m/Y");
        }

        /* get created at
        * @param string formatted date
        * return 
        */
        public function get_created_at()
        {
            return date_format(date_create($this->created_at), "d/m/Y"); 
        }

        /* get post id
        * return int post id
        */
        public function get_post_id()
        {
            return $this->post_id;
        }

        /* get image
        * return string image name
        */
        public function get_image()
        {
            return $this->image;
        }

        /* get user name
        * return string user name
        */
        public function get_user_name()
        {
            return $this->user_name;
        }

        /* set comments
        * @param comments array
        * return void
        */
        public function set_comments($comments){
            return $this->comments = $comments;
        }

        /* set user id
        * @param int user id
        * return void
        */
        public function set_user_id($other_user_id)
        {
            $this->user_id = $other_user_id;
        }

        /* set title
        * @param string title
        * return void
        */
        public function set_title ($other_title)
        {
            $this->title = $other_title;
        }

        /* set text 
        * @param string text
        * return void
        */
        public function set_text($other_text)
        {
            $this->text = $other_text;
        }

        /* set updated at
        * @param string updated at
        * return void
        */
        public function set_updated_at($other_updated_at)
        {
            $this->updated_at = $other_updated_at;
        }

        /* set created at
        * @param string created at
        * return 
        */
        public function set_created_at($other_created_at)
        {
            $this->created_at = $other_created_at;
        }

        /* set post id
        * @param string post id
        * return void
        */
        public function set_post_id($other_post_id)
        {
            $this->post_id = $other_post_id;
        }

        /* set image name
        * @param string image name
        * return void
        */
        public function set_image($image)
        {
            return $this->image = $image;
        }
    }

?>
