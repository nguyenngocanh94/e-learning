setQuestionThreshold($('#question_threshold').val());
$('.answer-item').click(function () {
    $me = $(this);
    $me.parent().addClass('selected');
    $me.parents('ul').prev().children('.the-hint').hide();
    $diff = $me.parent().siblings().children('a').removeClass('wrong');
    $diff = $me.parent().siblings().children('a').removeClass('right');
    if ( $me.data('requestRunning') ) {
        return;
    }

    $me.data('requestRunning', true);
    $data = {
        type: 'multi-choice',
        question_id: $me.parent().data('question'),
        answer_id: $me.data('answer')
    };
    AjaxFactory('/question/answer', $data, function ($result) {
        if ($result.rep === "FALSE"){
            $me.removeClass('set');
            $me.removeClass('right');
            $me.addClass('wrong');
            wrongAudio.play();
        }else {
            $question = $me.parents('.card');
            $question.addClass('done-all');
            $me.removeClass('set');
            $me.removeClass('wrong');
            $me.addClass('right');
            rightAudio.play();
        }
    }, $me);
});

$('.re-select').click(function () {
    $parent = $(this).parents('.card');
    $parent.children('.card-body-title').children('p.the-hint').hide();
    $theLi = $(this).parent().prev().children('.choice');
    $theLi.removeClass('selected');
    $theLi.each(function () {
        $(this).children().removeClass('set');
        $(this).children().removeClass('wrong');
        $(this).children().removeClass('right');
    })
});

$('.hint-pop').click(function () {
    $parent = $(this).parents('.card');
    if ($parent.children('ul').children('.selected').length > 0){
        $parent.children('.card-body-title').children('p.the-hint').show();
    }
});


let triggerBtn = function () {
    $rQ = $('.done-all').length;
    if ($rQ >= $questionThreshold){
        $('#pop_modal').prop('disabled', false);
    }
};

setInterval(triggerBtn, 5000);
