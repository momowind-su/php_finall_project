<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("models/CommentModel.php");
require_once("models/classes/Comment.php");

/* 
*coment controller
*/
class CommentController{

    /* get instance of comment model
    *  get instanse of auth model
    */
    public function __construct()
    {
        $this->Comment = CommentModel::getInstance();
        $this->auth = Auth::getInstance();
    }

    /* get comments for particular post
    * return array of comments ro empty array
    */
    public function getCommentsByPostId(): array
    {
        $post_id = $_POST['post_id'];

        if(isset($_POST['id'])){
            return $this->Comment::getCommentsByPostId($post_id);
        }
        return [];
    }

    /* delete comment
    * return json succes status
    */
    public function delete_comment(): void
    {
        $this->auth::has_permission(['admin','user']);

        if(isset($_POST['comment_id'])){
            if($this->Comment::deleteComment($_POST['comment_id']))
                echo json_encode(["success" => true]);
            else
                echo json_encode(["success" => false]);
        
        }
    }

    /* translate user object  to assoc
    * @param comment object
    * return assoc array
    */
    private function comment_to_array(Comment $comment): array
    {
        return [
            "comment_id" => $comment->get_comment_id(),
            "user_id" => $comment->get_user_id(),
            "user_name" => $comment->get_user_name(),
            "text" => $comment->get_text(),
            "created_at" => $comment->get_created_at(),
            "updated_at" => $comment->get_updated_at()
        ];
    }

    /* create comment
    * return json success status and newly creted comment on success
    * othervise json success false status
    */
    public function create_comment()
    {
        $this->auth::has_permission(['admin','user']);
        
        if(isset($_POST['comment']) && isset($_POST['post_id']) &&
            is_numeric($_POST['post_id']) && isset($_SESSION['user']))
        {

            $insert_id = $this->Comment::createComment($_POST['post_id'], $_SESSION['user']->get_user_id(), $_POST['comment']);
            $comment =  $this->Comment::getCommentById($insert_id);

            echo json_encode(["success" => true, "data" => $this->comment_to_array($comment)]);
            return;
        }
        echo json_encode(["success" => false]);
    }


}