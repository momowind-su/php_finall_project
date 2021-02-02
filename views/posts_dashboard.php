<?php require_once("parts/header_dashboard.php"); ?>
<h1><?=$title?> <?=$user_role?></h1>

<?php if($user_role == 'admin'): ?>
        <a class="btn btn-primary" href="/?m=post&a=create_post">Create post</a>
        <a class="btn btn-primary" href="/?m=post&a=download_posts">Download CSV</a>
<?php endif; ?>

<div class="row">
        <div class="col">
                <table class="table table-hover">
                <tr>
                        <td>Title</td>
                        <td>Text</td>
                        <td>Image</td>
                        <td>Created at</td>
                        <td></td>
                        <?php if($user_role == 'admin'): ?>
                                <td></td>
                                <td></td>
                        <?php endif; ?>
                </tr>
                <?php 
                foreach($posts as &$post){

                        echo "<tr>".
                                "<td>".$post->get_title()."</td>".
                                "<td>".$post->get_short_text()."</td>".
                                "<td><img src='".$post->get_image()."'/></td>".
                                "<td>".$post->get_created_at()."</div>";
                                if($user_role == 'admin'){
                                        echo "<td>".$post->link_to_update()."</td>".
                                              "<td>".$post->link_to_delete()."</td>";
                                }
                                echo "<td><button data-post-id='{$post->get_post_id()}' class='btn btn-primary btn-view-comments'>View comments</button></td>".
                        "</tr>";

                        $comments = $post->get_comments();

                        foreach($comments as $comment){
                                echo "<tr class='posts-comments post-comments-{$post->get_post_id()}' >".
                                        "<td>".$comment->get_user_name()."</td>".
                                        "<td>".$comment->get_text()."</td>".
                                        "<td>".$comment->get_created_at()."</div>".
                                        "<td></td>";
                                        if($user_role == 'admin'){
                                        echo "<td><button class='btn btn-danger btn-delete-comment' data-comment-id='{$comment->get_comment_id()}'>Delete</button></td>".
                                             "<td></td>".
                                             "<td></td>";
                                }

                                echo "</tr>";
                        }
                }
                ?>
                </table>
                </div>
        </div>
<script src='js/posts_dashboard.js'></script>
<?php require_once("parts/footer.php"); ?>