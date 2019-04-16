$('.answer-item').click(function () {
    $me = $(this);
    $diff = $me.parent().siblings('.selected').length;
    if ($diff<1){
        $me.addClass('set');
        $me.parent().addClass('selected');
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
            }else {
                $question = $me.parents('.card');
                if ($question.hasClass('done-essay')){
                    $question.removeClass('done-essay');
                    $question.addClass('done-all');
                }else{
                    $question.addClass('done-choice');
                }
                $me.removeClass('set');
                $me.removeClass('wrong');
                $me.addClass('right');
            }
        });
    }
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

$('.submit-essay').click(function () {
    $theEssay = $(this).parent().prev().prev().children('.essay').children().children('.essay-answer');
    $theEssayValue = $theEssay.val();
    $question = $(this).parents('.card');
    $questionId = $question.data('question');
    if ($theEssayValue != ''){
        AjaxFactory('/question/answer',
            {
                type: 'essay',
                question_id: $questionId,
                essay: $theEssayValue
            }, function ($res) {
                if ($res.rep === 'RIGHT'){
                    $theEssay.addClass('right');
                    if ($question.hasClass('done-choice')){
                        $question.removeClass('done-choice');
                        $question.addClass('done-all');
                    }else{
                        $question.addClass('done-essay');
                    }
                }else {
                    $theEssay.addClass('wrong');
                }
            })
    }
});

let triggerBtn = function () {
    $aQ = $('.card').length;
    $rQ = $('.done-all').length;
    if ($aQ === $rQ){
        $('#next_stage_quiz').prop('disabled', false);
    }
};

setInterval(triggerBtn, 10000);