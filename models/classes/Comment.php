<?php 

class Comment{
    private $comment_id;
    private $user_id;
    private $user_name;
    private $text;
    private $created_at;
    private $updated_at;

    /* get comment id
    * return int comment id
    */
    public function get_comment_id(): int
    {
        return $this->comment_id;
    }

    /* get user id
    * return user id
    */
    public function get_user_id(): int
    {
        return $this->user_id;
    }

    /* get user  name
    * return string user name
    */
    public function get_user_name(): string
    {
        return $this->user_name;
    }

    /* get text
    * return string text
    */
    public function get_text(): string
    {
        return $this->text;
    }

    /* get created at
    * return formatted string created at
    */
    public function get_created_at(){
        return date_format(date_create($this->created_at), "d/m/Y H:i");
    }

    /* get updated at
    * return formatted date string
    */
    public function get_updated_at(){
        return date_format(date_create($this->updated_at), "d/m/Y H:i");
    }

    /* set user id
    * @param int user id
    * return void
    */
    public function set_user_id($user_id){
        $this->user_id = $user_id;
    }

    /* set text 
    * @param string text
    * return void
    */
    public function set_text($text){
        $this->text = $text;
    }

    /* set created at
    * @param string created at
    * return void
    */
    public function set_created_at($created_at){
        $this->created_at = $created_at;
    }

    /* set updated at
    * @param string updated at
    * return void
    */
    public function set_updated_at($updated_at){
        $this->updated_at = $updated_at;
    }
}