<?php
require_once("classes/User.php");
require_once("Model.php");

/* user model class
*  singleton
*/
class UserModel extends Model
{
    protected static $class = "User";

    /* 
    *  creates instance of user model if needed
    */
    public static function getInstance()
    {
        if(self::$instance == NULL)
            self::$instance = new UserModel();
        return self::$instance;
    }

    /* get array of all users
    * return array of user class
    */
    public static function get_users(): array
    {
        $sql = "SELECT * FROM users";
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

    /* find user by given user id
    * @param int user id
    * return user object
    */
    public static function get_user(int $id): ?User
    {
        self::connect();
        $statement = self::$connection->prepare("SELECT * FROM users WHERE user_id = :id");
        $statement->execute([':id'=>$id]);
        $result = $statement->fetchObject(self::$class);
        self::disconnect();
        return $result ? $result : null;
    }

    /* find user by user id
    * @param string user email
    * return user object
    */
    public static function get_user_by_email(string $email): ?User
    {
        self::connect();
        $statement = self::$connection->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute([':email'=>$email]);
        $result = $statement->fetchObject(self::$class);
        self::disconnect();
        return $result ? $result : null;
    }

    /* creates user with given params
    * @param string first name
    * @param string last name
    * @param string password
    * @param string email
    * @param string role
    * return void
    */
    public static function create(string $first_name, string $last_name, string $password, string $email, string $role = 'user')
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

        try{
            $insert_id = self::$connection->prepare($sql)->execute($data);
            return $insert_id;
        }
        catch(Exception $e){
            return false;
        }
        finally{
            self::disconnect();
        }
    }

    /* update user with given data
    * @param string first name
    * @param string last name
    * @param string password
    * @param string email
    * @param string role
    * return number of affected rows
    */
    public static function edit_user(string $first_name, string $last_name, string $email, string $role, int $user_id): int
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
        $affected_rows = self::$connection->prepare($sql)->execute($data);
        self::disconnect();
        return $affected_rows;
    }

    /* delete user by user id
    * @param int user id
    * return number of affected rows
    */
    public static function delete_user(int $id): int
    {
        self::connect();
        
        $sql = "DELETE FROM  users WHERE user_id=:id";
        $affected_rows = self::$connection->prepare($sql)->execute([":id"=>$id]);
        self::disconnect();
        return $affected_rows;
        
    }

    /* update user password
    * @param string password
    * @param int user id
    * return number of affected rows
    */
    public static function update_password(string $password, int $id): int
    {
        $password = password_hash($password, PASSWORD_ARGON2I);

        self::connect();
        $sql = "UPDATE users SET password=:password WHERE user_id=:user_id";
        $insert_id = self::$connection->prepare($sql)->execute(["password" => $password, "user_id" => $id]);
        self::disconnect();
        return $insert_id;
    }
}