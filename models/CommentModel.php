<?php
    require_once("classes/Comment.php");
    require_once("Model.php");

/*
* comment model
* singleton
*/
class CommentModel extends Model
{
    protected static $class = "Comment";

    /* creates instance of coment model if needed
    * return instance of comment model
    */
    public static function getInstance()
    {
        if(self::$instance == null)
            self::$instance = new CommentModel();
        return self::$instance;
    }

    /* gets all comments for particular post by post id
    * @param postid
    * return 
    */
    public static function getCommentsByPostId(int $post_id): array 
    {
        self::connect();
        $sql = "SELECT *, ".
            "(SELECT CONCAT(first_name,' ',last_name) as fullname FROM users WHERE user_id=c.user_id) as user_name ".
            "FROM comments AS c ".
            "WHERE post_id = :post_id ".
            "ORDER BY created_at DESC ";
        $statement = self::$connection->prepare($sql);
        $statement->execute([':post_id'=>$post_id]);
        $result = $statement->fetchAll(PDO::FETCH_CLASS, self::$class);
        self::disconnect();
        return $result;
    }

    /* get comment by comment id
    * @param int comment id
    * return 
    */
    public static function getCommentById(int $comment_id): Comment
    {
        self::connect();
        $sql = "SELECT *,  ".
            "(SELECT CONCAT(first_name,' ',last_name) as fullname FROM users WHERE user_id=c.user_id) as user_name ".
            "FROM comments AS c ".
            "WHERE comment_id=:comment_id";

        $statement = self::$connection->prepare($sql);
        $statement->execute([':comment_id'=>$comment_id]);
        $comment = $statement->fetchObject(self::$class);
        self::disconnect();
        return $comment;
    }

    /* creates new comment
    * @param int post_id
    * @param int user_id
    * @param string text
    * return insert_id
    */
    public static function createComment(int $post_id, int $user_id, string $text): int
    {
        if(isset($_SESSION['user']))
        {
            $data = [
                "text" => $text,
                "user_id" => $user_id,
                "post_id" => $post_id
            ];

            self::connect();
            $sql = "INSERT INTO comments (text, user_id, post_id) VALUES (:text, :user_id, :post_id)";
            $affected_rows = self::$connection->prepare($sql)->execute($data);
            $insert_id = self::$connection->lastInsertId();
            self::disconnect();
            return $insert_id;
        }
    }

    /* delete comment by given comment_id
    * @param int comment_id
    * return number of affected rows
    */
    public static function deleteComment(int $comment_id): int
    {
        self::connect();
        $sql = "DELETE FROM comments WHERE comment_id=:comment_id";
        $affected_rows = self::$connection->prepare($sql)->execute([":comment_id"=>$comment_id]);
        self::disconnect();
        return $affected_rows;
    }


}