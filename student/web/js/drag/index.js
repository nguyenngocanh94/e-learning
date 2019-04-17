setQuestionThreshold($('#threshold_question').val());
$( function() {
    $( ".draggable" ).draggable();
    $( ".droppable" ).droppable({
        drop: function( event, ui ) {
            $place = $(this);
            $(".draggable").draggable("disable");
            $("#progress_bar").show();
            $dragger = $(ui.draggable);
            $rank = $place.data('rank');
            $id = $dragger.data('id');
            AjaxFactoryD('/question/answer', {
                id: $id,
                type: 'drag',
                rank: $rank
            }, function ($result) {
                if ($result.rep === "FALSE"){
                    $place.addClass('wrong');
                }else {
                    $place.addClass('right');
                    $dragger.css('border', '0px');
                    
                    $numberQ = $place.parent().children('.question-placehold').length;
                    $numberR = $place.parent().children('.right').length;
                    $questionId =  $dragger.parent().parent().prev().data('id');

                    if ($numberR  === $numberQ){
                        AjaxFactory('/question/update', {question_id: $questionId,  _csrf: csrfToken}, function($res){
                            if ($res.rep === "RIGHT"){
                                $place.parents('.mother-all').addClass('done');
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
    let $grids = Math.round(($answerPoolsH * $answerPoolsW)/(120*50));
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
           $range =Math.ceil($grids/3);
           $newH = (Math.ceil($position/$range)*50)-45;
           $newW =  Math.abs($position%$range) * 120;

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
            $('#next_stage').prop('disabled', false);
        }
    };

    setInterval(triggerBtn, 5000);

} );