<?php
class User{
    private $user_id;
    private $first_name;
    private $last_name;
    private $email;
    private $role;
    private $password;

    /* build form with action going to user page
    * return form html string
    */
    public function link_to_user()
    {
        return "<form method='POST' action='/?m=user&a=show_user'>"
                    ."<input type='hidden' name='id' value='".($this->get_user_id())."'>"
                    ."<button class='btn btn-primary'>Watch</button>"
                ."</form>";
    }

    /* build form with action going to update user page
    * return form html string
    */
    public function link_to_update()
    {
        return "<form method='POST' action='/?m=user&a=update_page'>"
                    ."<input type='hidden' name='id' value='".($this->get_user_id())."'>"
                    ."<button class='btn btn-success'>Update</button>"
                ."</form>";
    }

    /* build form with action going to delete user page
    * return form html string
    */
    public function link_to_delete()
    {
        return "<form method='POST' action='/?m=user&a=delete_user'>"
                    ."<input type='hidden' name='id' value='".($this->get_user_id())."'>"
                    ."<button class='btn btn-danger'>Delete</button>"
                ."</form>";
    }

    /* build form with action going to change password
    * return form html string
    */
    public function change_password_link()
    {
        return "<form method='POST' action='/?m=user&a=change_password'>"
                    ."<input type='hidden' name='id' value='".($this->get_user_id())."'>"
                    ."<button class='btn btn-danger'>Change password</button>"
                ."</form>";
    }

    /* get user id
    * return int user id
    */
    public function get_user_id(){
        return $this->user_id;
    }

    /* get first name
    * return string first name
    */
    public function get_first_name(){
        return $this->first_name;
    }

    /* get last name
    *  return string last name
    */
    public function get_last_name(){
        return $this->last_name;
    }

    /* get email
    * return string email
    */
    public function get_email(){
        return $this->email;
    }

    /* get password
    * @param string password
    * return 
    */
    public function get_password(){
        return $this->password;
    }

    /* get role
    * return string role
    */
    public function get_role(){
        return $this->role;
    }

    /* set user id
    * @param int user id
    * return void
    */
    public function set_user_id($user_id){
        $this->user_id = $user_id;
    }

    /* set first name
    * @param string first name
    * return void
    */
    public function set_first_name($first_name){
        $this->first_name = $first_name;
    }

    /* set last name
    * @param string last name
    * return void
    */
    public function set_last_name($last_name){
        $this->last_name = $last_name;
    }

    /* set email
    * @param string email
    * return void
    */
    public function set_email($email){
        $this->email = $email;
    }

    /* set pasword
    * @param string password
    * return void
    */
    public function set_password($password){
        $this->password = $password;
    }

    /* set role
    * @param string role
    * return void
    */
    public function set_role($role){
        $this->role = $role;
    }
}



