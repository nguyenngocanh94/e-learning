$('.register_course').click(function () {
    let me = $(this);
    if (me.data('requestRunning') ) {
        return;
    }
    me.data('requestRunning', true);
    let data = {
        course_id: $(this).data('id'),
        _csrf: csrfToken
    };
    AjaxFactory('/enroll/create', data, func, me);
});

let func = function () {
    $('#success_modal').modal('show');
    location.reload(true);
};

