let csrfToken = $('meta[name=csrf-token]').attr("content");
function AjaxFactory(url,  data, success, me) {
    return $.ajax({
        url: url,
        headers: {'X-CSRF-Token': csrfToken},
        type: 'post',
        data: data,
        success: success,
        complete: function() {
            me.data('requestRunning', false);
        }

    });
}
function AjaxFactoryD(url,  data, success, me) {
    return $.ajax({
        url: url,
        headers: {'X-CSRF-Token': csrfToken},
        type: 'post',
        data: data,
        success: success,
        complete: me

    });
}

let popNextButton = function popNextButton() {
    $('#next_stage').prop('disabled', false);
};
const $limitTime = $('#threshold_time_global').val();
const $questionThreshold = $('#threshold_question_global').val();
if ($limitTime > 0){
    setTimeout(popNextButton, $limitTime);
}
if ($questionThreshold == 0){
    $('#next_stage').prop('disabled', false);
    $('#next_stage_quiz').prop('disabled', false);
}

function setQuestionThreshold(value) {
    $('#threshold_question_global').val(value);
}

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}

$('#next_stage').click(function () {
    let me = $(this);
    if ( me.data('requestRunning') ) {
        return;
    }

    me.data('requestRunning', true);
    let data = {
        material_id: $(this).data('id'),
    };
    if($('#success_modal').is(':visible')){
        return;
    }else {
        AjaxFactory('/material/next', data, function () {
            location.reload(true);
        }, me);
    }

});