setQuestionThreshold($('#question_threshold').val());
$( function() {
    $( ".draggable" ).draggable();
    $( ".droppable" ).droppable({
        drop: function( event, ui ) {
            $place = $(this);
            $(".draggable").draggable("disable");
            $("#progress_bar").show();
            $dragger = $(ui.draggable);
            $rank = $place.data('rank');
            $id = $dragger.data('value');
            AjaxFactoryD('/question/answer', {
                value: $id,
                type: 'drag',
                rank: $rank
            }, function ($result) {
                if ($result.rep === "FALSE"){
                    $place.addClass('wrongx');
                }else {
                    $place.addClass('rightx');
                    $dragger.css('border', '0px');
                    
                    $numberQ = $place.parent().children('.question-placehold').length;
                    $numberR = $place.parent().children('.rightx').length;
                    $questionId =  $dragger.parent().parent().prev().children('.mother-all').data('id');

                    if ($numberR  === $numberQ){
                        AjaxFactoryN('/question/update', {question_id: $questionId,  _csrf: csrfToken}, function($res){
                            if ($res.rep === "RIGHT"){
                                $place.parents('.single-question').addClass('done');
                            }
                        });
                    }
                }
            }, function () {
                $(".draggable").draggable("enable");
                $("#progress_bar").hide();
            })
        }
    });

    $answerPools = $('.answer-pool');
    $answerPoolsH = $($answerPools[0]).height();
    $answerPoolsW = $($answerPools[0]).width();
    let answerItems = $answerPools.children();
    let $grids = Math.round((($answerPoolsH-20) * ($answerPoolsW-50))/(200*50));
    let gridPop = [];
    $answerPools.each(function (index, element) {
        gridPop = [];
        $(element).children().each(function (i,e) {
           while (1){
               $position = Math.round(getRandomArbitrary(1,$grids));
               if (gridPop.indexOf($position) === -1){
                   gridPop.push($position);
                   break;
               }
           }
           $range =Math.ceil($grids/8);
           $newH = (Math.ceil($position/$range)*50)-50;
           $newW =  Math.abs($position%$range) * 200;

            $(e).css({
                'left': $newW,
                'top' : $newH
            });
            $(e).show();
        });
    });

    let triggerBtn = function () {
        $rQ = $('.done').length;
        if ($rQ >= $questionThreshold){
            $('#pop_modal').prop('disabled', false);
        }
    };

    setInterval(triggerBtn, 5000);

} );

$('.check-drag').click(function () {
    if ($(this).parents('.single-question').hasClass('done')){
        rightAudio.play();
    }else {
        wrongAudio.play();
    }
});

$('.hint-show').click(function () {
   $hint = $(this).prev().val();
   $modal = $('#hint_modal');
    $modal.find('.modal-body p').text($hint);
    $modal.modal('show');
});