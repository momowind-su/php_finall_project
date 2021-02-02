<?php require_once("parts/header.php"); ?>
  <h1 class="text-center">Register</h1>
  <div class="row">
    <div class="col">
      <form action="/?m=auth&a=do_register" method="POST">
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
          <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" name="password" class="form-control" id="pwd" required>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
<?php require_once("parts/footer.php"); ?>
