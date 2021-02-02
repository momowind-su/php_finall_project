

$('.btn-view-comments').on('click', function(e){
    const post_id = $(this).attr('data-post-id');
    $('.posts-comments').hide(0, function(){
        $('.post-comments-'+post_id).slideDown(500);
    });
});

$('.btn-delete-comment').on('click', function(e){
    const comment_id = $(this).attr('data-comment-id');
    const parent = $(this).parent().parent();

    $.ajax({
        method: 'POST',
        url: '/?m=comment&a=delete_comment',
        data: {comment_id},
        dataType: 'json',
        success: function(res){
            if(res.success){
                parent.slideUp();
                alert('Comment deleted');
            }
            else
                alert('Unable to delete comment');
        },
        error: function(err){
            console.error(err);
        }
    });
});



