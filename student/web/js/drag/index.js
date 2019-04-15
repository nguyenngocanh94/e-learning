$( function() {
    $( ".draggable" ).draggable();
    $( ".droppable" ).droppable({
        drop: function( event, ui ) {
            $place = $(this);
            $dragger = $(ui.draggable);
            $rank = $place.data('rank');
            $id = $dragger.data('id');
            AjaxFactory('/question/drag', {
                id: $id,
                rank: $rank
            }, function ($result) {
                if ($result.rep === "FALSE"){
                    $place.addClass('wrong');
                }else {
                    $place.addClass('right');
                    $dragger.css('border', '0px');
                    
                    $numberQ = $dragger.parent().children().length;
                    $numberR = $place.parent().children('.right').length;
                    $questionId =  $dragger.parent().parent().prev().data('id');

                    if ($numberQ === $numberR){
                        AjaxFactory('/question/update', {question_id: $questionId,  _csrf: csrfToken}, function(){

                        });
                    }
                }
            })
        }
    });
} );