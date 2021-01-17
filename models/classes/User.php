<?php
class User{
    private $user_id;
    private $first_name;
    private $last_name;
    private $email;
    private $password;

    public function get_user_id(){
        return $this->user_id;
    }

    public function get_first_name(){
        return $this->first_name;
    }

    public function get_last_name(){
        return $this->last_name;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_password(){
        return $this->password;
    }

    public function set_user_id($user_id){
        return $this->user_id = $user_id;
    }

    public function set_first_name($first_name){
        return $this->first_name = $first_name;
    }

    public function set_last_name($last_name){
        return $this->last_name = $last_name;
    }

    public function set_email($email){
        return $this->email = $email;
    }

    public function set_password($password){
        return $this->password = $password;
    }
}



