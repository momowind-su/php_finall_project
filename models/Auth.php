<?php
require_once("classes/User.php");
require_once("UserModel.php");
require_once("Model.php");

class Auth extends Model
{
    protected static $class = "User";
    protected static $redirect_path = "/login";
    protected static $instance = NULL;
    protected static $session = NULL;
    protected static $userModel = NULL;

    protected function __construct(){
        session_start();
        self::$session = &$_SESSION;
        self::$userModel = UserModel::getInstance();
    }

    public static function getInstance(){
        if(self::$instance == NULL)
            self::$instance = new Auth();
        return self::$instance;
    }

    private function get_user($email){
        return self::$userModel = self::$get_user_by_email('email', $email);
    }

    public static function hash_password($pass){
        return password_hash($pass, PASSWORD_ARGON2I);
    }

    public static function login($email, $password){
        $user = self::$userModel::get_user_by_email($email);

        if($user && password_verify($password, $user->get_password()))
        {
            self::$session['user'] = $user;
            self::$session['role'] = $user->get_role();
            return require_once("/views/posts.php");
        }

        return false;
    }

    public static function register($first_name, $last_name, $password, $email)
    {
        $last_insert_id = self::$userModel::create($first_name, $last_name, $password, $email);
        
        if($last_insert_id)
        {
            self::$session['user'] = self::$userModel::get_user($last_insert_id);
            return true;
        }

        return false;
    }

    public static function logout(){
        session_unset();
        session_destroy();
    }

    public static function has_permission($permission, $redirect_back = true){

        if(!isset(self::$session['user']) || !in_array(self::$session['role'], $permission)){
            if($redirect_back){
                header('Location: '. $_SERVER['HTTP_REFERER']);
            }
            else{
                header('Location: ' . self::$redirect_path);
            }
        }
    }

}


