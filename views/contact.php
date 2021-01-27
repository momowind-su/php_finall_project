<?php require_once("parts/header.php"); ?>
<h1 class="text-center">Contact</h1>
<div class="row">
  <div class="col">
    <form action="/?m=contact&a=send_email" method="POST">
      <div class="form-group">
        <label for="subject">Subject</label>
        <input name="subject" type="text" class="form-control" id="subject" required>
      </div>
      <div class="form-group">
        <label for="password">Message</label>
        <textarea name="message" type="text" class="form-control" id="message" required></textarea>
      </div>
      <div class="form-group">
        <label for="email">Email address:</label>
        <input name="email" type="email" class="form-control" id="email" required>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
</div>
<?php require_once("parts/footer.php"); ?>
