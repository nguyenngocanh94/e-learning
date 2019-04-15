$('#next_stage').click(function () {
    let data = {
        material_id: $(this).data('id'),
        _csrf: csrfToken
    };
    AjaxFactory('/material/next', data, func);
});

let func = function () {
    $('.modal').modal('show');
};

