<?php
class User{
    private $user_id;
    private $first_name;
    private $last_name;
    private $email;
    private $role;
    private $password;

    public function link_to_user()
    {
        return "<form method='POST' action='/?m=user&a=show_user'>"
                    ."<input type='hidden' name='id' value='".($this->get_user_id())."'>"
                    ."<button class='btn btn-primary'>Watch</button>"
                ."</form>";
    }

    public function link_to_update()
    {
        return "<form method='POST' action='/?m=user&a=update_page'>"
                    ."<input type='hidden' name='id' value='".($this->get_user_id())."'>"
                    ."<button class='btn btn-success'>Update</button>"
                ."</form>";
    }

    public function link_to_delete()
    {
        return "<form method='POST' action='/?m=user&a=delete_user'>"
                    ."<input type='hidden' name='id' value='".($this->get_user_id())."'>"
                    ."<button class='btn btn-danger'>Delete</button>"
                ."</form>";
    }

    public function change_password_link()
    {
        return "<form method='POST' action='/?m=user&a=change_password'>"
                    ."<input type='hidden' name='id' value='".($this->get_user_id())."'>"
                    ."<button class='btn btn-danger'>Change password</button>"
                ."</form>";
    }

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

    public function get_role(){
        return $this->role;
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

    public function set_role($role){
        return $this->role = $role;
    }
}



