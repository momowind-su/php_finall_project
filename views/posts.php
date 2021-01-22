<?php require_once("parts/header.php"); ?>
<h1>Posts</h1>
<div>
       
        <?php 
        foreach($posts as $post){
           echo "<div class='card' style='width: 18rem;'>".
                   "<div class='card-header'>".$post->get_created_at()."</div>".
                    "<div class='card-body'>".
                        "<h5 class='card-title'>".$post->get_title()."</h5>".
                        "<p class='card-text'>".$post->get_text()."</p>".
                        $post->link_to_post().
                    "</div>".
                "</div>";
        
        }
        ?>
</div>
<?php require_once("parts/footer.php"); ?>