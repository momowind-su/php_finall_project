
$('#send_comment').on('click', function(){
    const comment = $('#comment').val();
    const post_id = $('#post_id').val();

    if(comment && post_id){
        $.ajax({
            method: "POST",
            url: "/?m=comment&a=create_comment",
            dataType: 'json',
            data: {comment, post_id },
            success: function(res){
                const container = $('#comments-container');
                if(res.success)
                {
                    const comment = res.data;
                    const html = "<div class='d-flex flex-column comment-section'>"+
                                        "<div class='bg-white p-2'>"+
                                        "<div class='d-flex flex-row user-info'>"+
                                                "<div class='d-flex flex-column justify-content-start ml-2'>"+
                                                    "<span class='d-block font-weight-bold name'>"+comment.user_name+"</span>"+
                                                    "<span class='date text-black-50'>"+comment.created_at+"</span>"+
                                                "</div>"+
                                        "</div>"+
                                                "<div class='mt-2'>"+
                                                        "<p class='comment-text'>"+comment.text+"</p>"+
                                                "</div>"+
                                        "</div>"+
                                "</div>";

                    container.prepend(html);
                }
                else
                {
                    console.warn(res)
                }

            },
            error: function(err){
                console.log(err);
            }
        })
    }
});























