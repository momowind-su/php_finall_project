<?php
require_once("models/Auth.php");

class AuthController{

    public function __construct(){
        $this->auth =  Auth::getInstance();
        
    }

    public function login_page()
    {
        
        return  require_once("/views/login.php");
    }


}