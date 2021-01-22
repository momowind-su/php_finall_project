<?php
require_once("classes/User.php");
require_once("Model.php");

class Auth extends Model
{
    protected static $class = "User";
    protected static $redirect_path = "/login";
    protected static $instance = NULL;
    protected static $session = NULL;

    //constructor
    protected function __construct(){
        session_start();
        self::$session = $_SESSION;
                
    }

    //geters
    public static function getInstance(){
        if(self::$instance == NULL)
            self::$instance = new Auth();
        return self::$instance;
    }

    private function get_user($email){
        return self::$user = self::$get_user_by_email('email', $email);
    }


    //other methods
    public static function hash_password($pass){
        return password_hash($pass, PASSWORD_ARGON2I);
    }

    public static function login($email, $password){
        self::$get_user($email);
        
        if(self::$user->email){
            if(password_verify($password, self::$password)){
                self::$session['user'] = self::$user;
                return true;
            }
        }
        return false;
    }

    public static function logout(){
        session_unset();
        session_destroy();
    }

    public static function has_permission($permission, $redirect_back = true){
        if(!isset(self::$user) || self::$user->role != $permission){
            if($redirect_back){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else{
                header('Location: ' . self::$redirect_path);
            }
        }
    }

}


