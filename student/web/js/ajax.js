const csrfToken = $('meta[name=csrf-token]').attr("content");
const url = $(location).attr("href");
const  rightAudio = new Audio('/audio/right');
const  wrongAudio = new Audio('/audio/wrong');
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

function AjaxFactoryGet(url, data, success, me) {
    return $.ajax({
        url: url,
        headers: {'X-CSRF-Token': csrfToken},
        type: 'get',
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

function AjaxFactoryDG(url, data, success, me) {
    return $.ajax({
        url: url,
        headers: {'X-CSRF-Token': csrfToken},
        type: 'get',
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

function AjaxFactoryG(url, data, success) {
    return $.ajax({
        url: url,
        headers: {'X-CSRF-Token': csrfToken},
        type: 'get',
        data: data,
        success: success

    });
}

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}


function setQuestionThreshold(value) {
    $('#threshold_time_global').val(value);
}


function setLimitTime(value) {
    $('#limit_').val(value);
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
$('#search-course').keyup(_.debounce(function(){
    let keyS = {
        course_name : $(this).val(),
        adv_data : $('#adv-info').serialize()
    };
    if (url.includes('course/index')){
        let ajax = AjaxFactoryG('/course/search', keyS, function ($res) {
            $('.course-list').html($res);
        });
    }
} , 500));

$('.end-game').children('p').children('a').attr('target','_blank');
