<?php require_once("parts/header_dashboard.php"); ?>
  <h1 class="text-center">Add new user</h1>
  <div><?=$this->get_message()?></div>
  <div class="row">
    <div class="col">
      <form action="/?m=user&a=add_user" method="POST">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input name="last_name" class="form-control" id="last_name" required>
        </div>
        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="text" name="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" name="password" class="form-control" id="pwd" required>
        </div>
        <div class="form-group">
          <label for="pwd">User role:</label>
          <select class="form-control" name="role" id="role" required>
            <option value="user">Regular user</option>
            <option value="admin">Administrator</option>
          </select>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
<?php require_once("parts/footer.php"); ?>