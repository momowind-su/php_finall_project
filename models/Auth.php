<?php
require_once("classes/User.php");
require_once("UserModel.php");
require_once("Model.php");

/* Authentication model
*   singleton
*/
class Auth extends Model
{
    protected static $class = "User";
    protected static $redirect_path = "/login";
    protected static $instance = NULL;
    protected static $session = NULL;
    protected static $userModel = NULL;

    /* 
    * Start session and get user model instanse
    */
    protected function __construct(){
        session_start();
        self::$session = &$_SESSION;
        self::$userModel = UserModel::getInstance();
    }

    /* make if needed self instance
    * @param non
    * return instance of Auth class
    */
    public static function getInstance(): Auth
    {
        if(self::$instance == NULL)
            self::$instance = new Auth();
        return self::$instance;
    }

    /* hashing password
    * @param password string
    * return hashed password
    */
    public static function hash_password(string $pass): string
    {
        return password_hash($pass, PASSWORD_ARGON2I);
    }

    /* find user and check entered pasword agains given, writes user to session
    * @param user email and password
    * return if user found true othevise false
    */
    public static function login(string $email, string $password): bool
    {
        $user = self::$userModel::get_user_by_email($email);

        if($user && password_verify($password, $user->get_password()))
        {
            self::$session['user'] = $user;
            self::$session['role'] = $user->get_role();
            return true;
        }

        return false;
    }

    /* registers new user to system
    * @param string first name, string last name, string password , string email
    * return on success true othervise false
    */
    public static function register(string $first_name, string $last_name, string $password, string $email): bool
    {
        $last_insert_id = self::$userModel::create($first_name, $last_name, $password, $email);
        
        if($last_insert_id)
        {
            $user = self::$userModel::get_user_by_email($email);
            self::$session['user'] = self::$userModel::get_user($last_insert_id);
            self::$session['role'] = $user->get_role();
            return true;
        }

        return false;
    }

    /* makes logout, completly destroy session
    * @param none
    * return void
    */
    public static function logout(): void
    {
        session_unset();
        session_destroy();
    }

    /* check if logged user has proper permission
    * @param array of permissions, type o redirect
    * return void
    */
    public static function has_permission(array $permission, bool $redirect_back = true): void
    {
        if(!isset(self::$session['user']) || !in_array(self::$session['role'], $permission)){
            if($redirect_back){
                header('Location: /?m=post&a=posts_page');
            }
            else{
                header('Location: ' . self::$redirect_path);
            }
        }
    }

}


