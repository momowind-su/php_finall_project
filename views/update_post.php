<?php require_once("parts/header_dashboard.php"); ?>
  <h1 class="text-center">Update post</h1>
  <div class="row">
    <div class="col">
      <p><?=$post->get_user_name();?>, <?=$post->get_created_at();?></p>
      <form action="/?m=post&a=do_update" method="POST">
        <input value="<?=$post->get_post_id()?>" type="text" name="post_id" hidden>
        <div class="form-group">
            <label for="title">Title</label>
            <textarea type="text" name="title" class="form-control" id="title" required ><?=$post->get_title()?></textarea>
        </div>
        <div class="form-group">
            <label for="text">Text</label>
            <textarea type="text" rows="15" name="text" class="form-control" id="text" required ><?=$post->get_text()?></textarea>
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