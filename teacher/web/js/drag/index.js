let csrfToken = $('meta[name=csrf-token]').attr("content");
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

$('.component-pool').sortable({
    stop: function (e, ui) {
        $it = $(ui.item);
        if ($it.data("rank") === ui.item.index()+1) {
            return true;
        }else {
            let data = {
                question_id: $it.data('qid'),
                id :  $it.data('id'),
                rank: ui.item.index()+1
            };

            $('.component-pool').sortable( "disable" );

            AjaxFactoryD('/component-question/order', data, function () {

            }, function () {
                $('.component-pool').sortable( "enable" );
            })
        }
    }
});
