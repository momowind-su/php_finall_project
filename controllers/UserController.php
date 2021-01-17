<?php
require_once("models/Auth.php");
require_once("models/UserModel.php");

class UserController{

    public function __construct(){
        $this->model = UserModel::getInstance();
        $this->auth = Auth::getInstance();
    }

    public function show_users(){
        $users = $this->model::get_users();
        require_once("views/users.php");
    }

    public function show_user(){
        // $this->auth::has_permission('admin');

        $user_id = $_REQUEST['id'];

        if($user_id){
            $user = $this->model::get_user($user_id);
            require_once("views/user.php");
        }
    }

}
