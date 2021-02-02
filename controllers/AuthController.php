<?php
require_once("models/Auth.php");

/* auth controller
* all methods for user authentication
* and views
*/
class AuthController{

    /* 
    * get instance of auth class model
    */
    public function __construct(){
        $this->auth = Auth::getInstance();
    }

    /* show login page
    * return void
    */
    public function login_page(): void
    {
        require_once("views/login.php");
    }

    /* check password and email and redirect
    * return header redirect
    */
    public function do_login()
    {
        if(isset($_POST['password']) && isset($_POST['email']))
        {
            if($this->auth::login($_POST['email'], $_POST['password']))
            {
                return header('Location: /?m=user&a=show_users');
            }
        }

        if(isset($_SERVER['HTTP_REFERER']))
            return header('Location: ' . $_SERVER['HTTP_REFERER']);

        return header('Location: /?m=auth&a=login_page');
    }

    /* do user logout, arise session
    * return header redirect to login page
    */
    public function do_logout()
    {
        $this->auth::logout();
        return header('Location: /?m=auth&a=login_page');
    }

    /* show register page
    * return void
    */
    public function register_page(): void
    {
        require_once("views/register.php");
    }

    /* do new user registration
    * return header redirect to dashboard on success othervise redirect back
    */
    public function do_register()
    {
        if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['password']) && isset($_POST['first_name']))
        {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']); 
            $last_name = htmlspecialchars($_POST['last_name']); 
            $first_name = htmlspecialchars($_POST['first_name']);

            if($this->auth::register($first_name, $last_name, $password, $email))
            {
                header('Location: /?m=user&a=show_users');
            }
            else{
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }

}