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

    public static function get_user_by_email(string $email)
    {
        self::connect();
        $statement = self::$connection->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute([':email'=>$email]);
        $result = $statement->fetchObject(self::$class);
        self::disconnect();
        return $result;
    }

    public static function create($first_name, $last_name, $password, $email, $role = 'user')
    {
        $password = password_hash($password, PASSWORD_ARGON2I);

        $data = [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "password" => $password,
            "email" => $email,
            "role" => $role
        ];

        self::connect();
        
        $sql = "INSERT INTO users (first_name, last_name,  password, email, role) VALUES (:first_name, :last_name, :password, :email, :role)";
        $insert_id = self::$connection->prepare($sql)->execute($data);
        self::disconnect();
        return $insert_id;
    }

    public static function edit_user($first_name, $last_name, $email, $role, $user_id)
    {
        $data = [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "role" => $role,
            "user_id" => $user_id
        ];

        self::connect();
        $sql = "UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, role=:role WHERE user_id=:user_id";
        $insert_id = self::$connection->prepare($sql)->execute($data);
        self::disconnect();
        return $insert_id;
    }

    public static function delete_user($id)
    {
        self::connect();
        
        $sql = "DELETE FROM  users WHERE user_id=:id";
        $insert_id = self::$connection->prepare($sql)->execute([":id"=>$id]);
        self::disconnect();
        return $insert_id;
        
    }

    public static function update_password($password, $id)
    {
        $password = password_hash($password, PASSWORD_ARGON2I);

        self::connect();
        $sql = "UPDATE users SET password=:password WHERE user_id=:user_id";
        $insert_id = self::$connection->prepare($sql)->execute(["password" => $password, "user_id" => $id]);
        self::disconnect();
        return $insert_id;
    }
}