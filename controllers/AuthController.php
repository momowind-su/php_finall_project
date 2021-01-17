<?php
require_once("models/Auth.php");

class AuthController{

    public function __construct(){
        print "Hello";
        $this->auth = new Auth();
    }

    public function login_page(){
        return  require_once("../views/login.php");
    }

}