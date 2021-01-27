<?php require_once("parts/header.php"); ?>
<h1><?=$title?></h1>
<div class="row">
        <div class="col">
        <?php 
        foreach($posts as $post){
                echo "<div class='card mb-4'>".
                        "<div class='card-header'>".$post->get_user_name().' '.$post->get_created_at()."</div>".
                        "<div class='card-body'>".
                                "<h5 class='card-title'>".$post->get_title()."</h5>".
                                "<p class='card-text'>".$post->get_short_text()."</p>".
                                $post->link_to_post().
                        "</div>".
                      "</div>";
                }
        ?>
        </div>
</div>
<?php require_once("parts/footer.php"); ?>