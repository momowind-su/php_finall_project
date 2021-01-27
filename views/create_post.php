<?php require_once("parts/header_dashboard.php"); ?>
  <h1 class="text-center">Create post</h1>
  <div class="row">
    <div class="col">
      <form action="/?m=post&a=do_create" method="POST">
        <div class="form-group">
            <label for="title">Title</label>
            <textarea type="text" name="title" class="form-control" id="title" required ></textarea>
        </div>
        <div class="form-group">
            <label for="text">Text</label>
            <textarea type="text" rows="15" name="text" class="form-control" id="text" required ></textarea>
        </div>
        <!-- <div class="form-group">
          <label for="image">Image</label>
          <textarea value="< ?=$post->get_image()?>" type="file" name="image" class="form-control" id="image" required ></textarea>
        </div> -->
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
<?php require_once("parts/footer.php"); ?>