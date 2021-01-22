<?php
require_once("classes/User.php");
require_once("Model.php");

class UserModel extends Model
{
    protected static $class = "User";

    public static function getInstance()
    {
        if(self::$instance == NULL)
            self::$instance = new UserModel();
        return self::$instance;
    }

    public static function get_users()
    {
        $sql = ("SELECT * FROM users");
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

    public static function get_user(int $id)
    {
        self::connect();
        $statement = self::$connection->prepare("SELECT * FROM users WHERE user_id = :id");
        $statement->execute([':id'=>$id]);
        $result = $statement->fetchObject(self::$class);
        self::disconnect();
        return $result;
    }

    public static function get_user_by_email(int $email)
    {
        self::connect();
        $statement = self::$connection->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute([':email'=>$email]);
        $result = $statement->fetchObject(self::$class);
        self::disconnect();
        return $result;
    }
}
?>