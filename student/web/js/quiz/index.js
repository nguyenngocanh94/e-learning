$('.answer-item').click(function () {
    $me = $(this);
    $diff = $me.parent().siblings('.selected').length;
    if ($diff<1){
        $me.addClass('set');
        $me.parent().addClass('selected');
        $data = {
            question_id: $me.parent().data('question'),
            answer_id: $me.data('answer')
        };
        AjaxFactory('/question/answer', $data, function ($result) {
            if ($result.rep === "FALSE"){
                $me.removeClass('set');
                $me.removeClass('right');
                $me.addClass('wrong');
            }else {
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
    $theLi = $(this).parent().prev().children();
    $theLi.removeClass('selected');
    $theLi.each(function () {
        $(this).children().removeClass('set');
    })
});

$('.hint-pop').click(function () {
    $parent = $(this).parents('.card');
    if ($parent.children('ul').children('.selected').length > 0){
        $parent.children('.card-body-title').children('p.the-hint').show();
    }
});