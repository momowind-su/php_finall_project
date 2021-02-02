<?php require_once("parts/header.php"); ?>
<div class="row">
        <div class="col">
                <h1><?=$title?></h1>
        <?php
        echo    "<div class='card'>".
                        "<div class='card-header font-weight-bold name'>".$post->get_user_name().' '.$post->get_created_at()."</div>".
                        "<div class='card-body'>".
                                "<h5 class='card-title'>".$post->get_title()."</h5>".
                                "<p class='card-text'>".$post->get_text()."</p>".
                        "</div>".
                "</div>";
        
        if(isset($_SESSION['user'])): ?>

                <div class="bg-light p-2">
                        <form action="/?m=comment&a=create_comment" method="POST">
                                <input type="hidden" id="post_id" value='<?=$post->get_post_id()?>'>
                                <div class="d-flex flex-row align-items-start">
                                        <textarea id="comment" class="form-control ml-1 shadow-none textarea"></textarea>
                                </div>
                                <div class="mt-2 text-right">
                                        <button id="send_comment" class="btn btn-primary btn-sm shadow-none" type="button">Post comment</button>
                                </div>
                        </form>
                </div>

        <?php endif;

        echo "<div id='comments-container'>";
        foreach($comments as $comment){

                echo "<div class='d-flex flex-column comment-section'>".
                        "<div class='bg-white p-2'>".
                        "<div class='d-flex flex-row user-info'>".
                                "<div class='d-flex flex-column justify-content-start ml-2'><span class='d-block font-weight-bold name'>".$comment->get_user_name()."</span><span class='date text-black-50'>".$comment->get_created_at()."</span></div>".
                        "</div>".
                                "<div class='mt-2'>".
                                        "<p class='comment-text'>".$comment->get_text()."</p>".
                                "</div>".
                        "</div>".
                "</div>";

                }
        echo "</div>";
        ?>



        </div>
</div>
<script src="js/post.js"></script>
<?php require_once("parts/footer.php"); ?>