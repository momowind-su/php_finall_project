<?php require_once("parts/header.php"); ?>
  <h1 class="text-center">Login</h1>
  <div class="row">
    <div class="col">
      <form action="/?m=user&a=update_password" method="POST">
      <input name="id" value="<?=$id?>" type="hidden">
      <div class="form-group">
          <label for="password">Password:</label>
          <input name="password" type="password" class="form-control" id="password" required>
        </div>
        <div class="form-group">
          <label for="password2">Reenter password:</label>
          <input name="password2" type="password" class="form-control" id="password2" required>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
<?php require_once("parts/footer.php"); ?>
