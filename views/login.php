<?php require_once("parts/header.php"); ?>
  <h1 class="text-center">Login</h1>
  <div class="row">
    <div class="col">
      <form action="/?m=auth&a=do_login" method="POST">
        <div class="form-group">
          <label for="email">Email address:</label>
          <input name="email" type="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input name="password" type="password" class="form-control" id="password" required>
        </div>
        <?php $this->do_login(); ?>
    </div>
  </div>
<?php require_once("parts/footer.php"); ?>
