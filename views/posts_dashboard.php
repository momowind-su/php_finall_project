<?php require_once("parts/header_dashboard.php"); ?>
<h1><?=$title?></h1>
<a class="btn btn-primary" href="/?m=post&a=create_post">Create post</a>
<a class="btn btn-primary" href="/?m=post&a=download_posts">Download CSV</a>
<div class="row">
        <div class="col">
                <table class="table table-hover">
                <tr>
                        <td>Title</td>
                        <td>Text</td>
                        <td>Image</td>
                        <td>Created at</td>
                        <td></td>
                        <td></td>
                </tr>
                <?php 
                foreach($posts as $post){
                        echo "<tr>".
                                "<td>".$post->get_title()."</td>".
                                "<td>".$post->get_short_text()."</td>".
                                "<td><img src='".$post->get_image()."'/></td>".
                                "<td>".$post->get_created_at()."</div>".
                                "<td>".$post->link_to_update()."</td>".
                                "<td>".$post->link_to_delete()."</td>".
                        "</tr>";
                        }
                ?>
                </table>
                </div>
        </div>
<?php require_once("parts/footer.php"); ?>