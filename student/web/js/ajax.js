let csrfToken = $('meta[name=csrf-token]').attr("content");

function AjaxFactory(url, data, success, me) {
    return $.ajax({
        url: url,
        headers: {'X-CSRF-Token': csrfToken},
        type: 'post',
        data: data,
        success: success,
        complete: function () {
            me.data('requestRunning', false);
        }

    });
}

function AjaxFactoryD(url, data, success, me) {
    return $.ajax({
        url: url,
        headers: {'X-CSRF-Token': csrfToken},
        type: 'post',
        data: data,
        success: success,
        complete: me

    });
}

function AjaxFactoryN(url, data, success) {
    return $.ajax({
        url: url,
        headers: {'X-CSRF-Token': csrfToken},
        type: 'post',
        data: data,
        success: success

    });
}


function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}


function setQuestionThreshold(value) {
    $('#threshold_question_global').val(value);
}


$('#pop_modal').click(function () {
    $modal = $('#success_modal');
    $modal.modal('show');
});

$('#next_stage').click(function () {
    let data = {
        material_id: $(this).data('id'),
    };
    AjaxFactoryN('/material/next', data, function ($res) {
        if ($res.rep === "success") {
            window.location.href = '/lession/index?course_id=' + $('#course_id').val();
        } else {
            location.reload(true);
        }
    });
});