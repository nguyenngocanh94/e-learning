$('.send-essay').click(function () {
    $btn = $(this);
    let me = $(this);

    if ( me.data('requestRunning') ) {
        return;
    }

    me.data('requestRunning', true);


    $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\n' +
        '  Đang gửi ...');
    $btn.prop('disabled', true);
    $smForm = $(this).parent().prev().children().children('form');
    AjaxFactory('/question/answer', $smForm.serializeArray(), function () {
        $btn.html('<i class="fas fa-check"></i> Đã gửi câu trả lời');

    }, me);
});