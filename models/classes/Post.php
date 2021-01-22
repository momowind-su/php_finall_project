<?php

    Class Post
    {
        private $user_id;
        private $title;
        private $text;
        private $updated_at;
        private $created_at;
        private $post_id;

        public function link_to_post()
        {
            
            return "<form method='POST' action='?m=post&a=post_page'>"
                        ."<input type='hidden' name='id' value='".($this->get_post_id())."'>"
                        ."<button class='btn btn-primary'>Read</button>"
                    ."</form>";
        }


        //geters

        public function get_user_id()
        {
            return $this->user_id;
        }
    
        public function get_title()
        {
            return $this->title;
        }

        public function get_text()
        {
            return $this->text;
        }
        public function get_updated_at()
        {
            $this->updated_at;
        }

        public function get_created_at()
        {
            
            return $this->created_at; 
        }

        public function get_post_id()
        {
            return $this->post_id;
        }


        //stters
        public function set_user_id($other_user_id)
        {
            $this->user_id = $other_user_id;
        }

        public function set_title ($other_title)
        {
            $this->title = $other_title;
        }

        public function set_text($other_text)
        {
            $this->text = $other_text;
        }

        public function set_updeted_at($other_updated_at)
        {
            $this->updated_at = $other_updated_at;
        }

        public function set_created_at($other_created_at)
        {
            $this->created_at = $other_created_at;
        }
        
        public function set_post_id($other_post_id)
        {
            $this->post_id = $other_post_id;
        }
    }

?>
