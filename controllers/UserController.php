<?php
require_once("models/Auth.php");
require_once("models/UserModel.php");

class UserController{

    private $message = '';

    public function __construct(){
        $this->model = UserModel::getInstance();
        $this->auth = Auth::getInstance();
    }

    public function user(){
        $request_method=$_SERVER["REQUEST_METHOD"];

        switch($request_method){
            case 'POST':
                $this->show_user();
        }
    }

    public function show_users(){
        $this->auth::has_permission(['admin','user']);

        $title = "Users";
        $user_role = $_SESSION['role'] ?? '';
        $users = $this->model::get_users();
        require_once("views/users.php");
    }

    public function show_user(){
        $this->auth::has_permission(['user', 'admin']);
        $user_role = $_SESSION['role'] ?? '';
        $user_id = $_REQUEST['id'];

        if($user_id)
        {
            $title = "User";
            $user = $this->model::get_user($user_id);
            require_once("views/user.php");
        }
        else
        {
            header('Location: '. $_SERVER['HTTP_REFERER']);
        }
    }

    public function create_user()
    {
        $this->auth::has_permission(['admin']);
        $this->message = '';
        require_once("views/create_user.php");
    }

    public function add_user()
    {
        $this->auth::has_permission(['admin']);
        $this->message = "Unable to add user";

        if(isset($_POST['first_name']) && $_POST['last_name'] &&
            $_POST['password'] && $_POST['email'] && $_POST['role'])
        {
            if($this->model->create($_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['email'], $_POST['role']))
            {
                $this->message = "User $_POST[first_name] $_POST[last_name] added successfuly";
            }
        }

        header('Location: '. $_SERVER['HTTP_REFERER']);
    }

    public function update_page()
    {
        $this->auth::has_permission(['user','admin']);

        if(isset($_POST['id']) && is_numeric($_POST['id']))
        {
            $title = "Update user";
            $user = $this->model::get_user($_POST['id']);
            require_once("views/update_user.php");
        }
        else
        {
            header('Location: '. $_SERVER['HTTP_REFERER']);
        }
    }

    public function update_user()
    {
        $this->auth::has_permission(['user','admin']);
        $this->message = "Unable to update user";

        if(isset($_POST['first_name']) && $_POST['last_name'] &&
            $_POST['email'] && $_POST['role'] && $_POST['user_id'])
        {
            if($this->model::edit_user($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['role'], $_POST['user_id']))
            {
                $this->message = "User $_POST[first_name] $_POST[last_name] added successfuly";
            }
        }

        header('Location: /?m=user&a=show_users');
    }

    public function delete_user()
    {
        $this->auth::has_permission(['admin']);
        if($_POST['id'] && is_numeric($_POST['id']))
        {
            try{
                $this->model::delete_user($_POST['id']);
            }
            catch(Exception $e)
            {
                echo $e->toString();
            }
        }
        header('Location: '. $_SERVER['HTTP_REFERER']);
    }

    public function change_password()
    {
        $this->auth::has_permission(['admin','user']);
        $title = "Change password";

        if(isset($_POST['id']) && is_numeric($_POST['id']))
        {
            $id = $_POST['id'];
            require_once("views/change_password.php");
        }
    }

    public function update_password()
    {
        $this->auth::has_permission(['user', 'admin']);

        if(isset($_POST['id']) && isset($_POST['password']) && isset($_POST['password2']) && $_POST['password'] == $_POST['password2']){
            $this->model::update_password($_POST['password'], $_POST['id']);
        }
        header('Location: /?m=user&a=show_users');
    }

    public function get_message()
    {
        return $this->message;
    }
}
