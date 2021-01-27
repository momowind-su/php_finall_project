<?php require_once("parts/header_dashboard.php"); ?>
  <h1 class="text-center">Add new user</h1>
  <div class="row">
    <div class="col">
      <form action="/?m=user&a=update_user" method="POST">
        <input value="<?=$user->get_user_id()?>" type="text" name="user_id" hidden>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input value="<?=$user->get_first_name()?>" type="text" name="first_name" class="form-control" id="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input value="<?=$user->get_last_name()?>" name="last_name" class="form-control" id="last_name" required>
        </div>
        <div class="form-group">
          <label for="email">Email address:</label>
          <input value="<?=$user->get_email()?>" type="text" name="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
          <label for="pwd">User role:</label>
          <select class="form-control" name="role" id="role" required>
            <option value="user" <?=($user->get_role()=="user"?"selected":"")?>>Regular user</option>
            <option value="admin" <?=($user->get_role()=="admin"?"selected":"")?>>Administrator</option>
          </select>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
<?php require_once("parts/footer.php"); ?>