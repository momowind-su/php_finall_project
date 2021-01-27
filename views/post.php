<?php require_once("parts/header.php"); ?>
<div class="row">
        <div class="col">
                <h1><?=$title?></h1>
                <?php
                echo "<div class='card'>".
                        "<div class='card-header'>".$post->get_user_name().' '.$post->get_created_at()."</div>".
                        "<div class='card-body'>".
                                "<h5 class='card-title'>".$post->get_title()."</h5>".
                                "<p class='card-text'>".$post->get_text()."</p>".
                        "</div>".
                "</div>";
                ?>
        </div>
</div>
<?php require_once("parts/footer.php"); ?>