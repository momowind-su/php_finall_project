<?php
require_once("models/Auth.php");

class AuthController{

    public function __construct(){
        $this->auth = Auth::getInstance();
    }

    public function login_page(){
        return  require_once("views/login.php");
    }

    public function do_login()
    {
        if(isset($_POST['password']) && isset($_POST['email']))
        {
            if($this->auth::login($_POST['email'], $_POST['password']))
            {
                return header('Location: /?m=user&a=show_users');
            }
        }
        else
            return header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function do_logout()
    {
        $this->auth::logout();
        return header('Location: /?m=auth&a=login_page');

    }

    public function register_page()
    {
        return  require_once("views/register.php");
    }

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