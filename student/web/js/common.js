let popNextButton = function popNextButton() {
    $('#pop_modal').prop('disabled', false);
};
const $limitTime = $('#threshold_time_global').val();
const $questionThreshold = $('#threshold_question_global').val();
if ($limitTime > 0){
    setTimeout(popNextButton, $limitTime);
}
if ($questionThreshold == 0){
    $('#pop_modal').prop('disabled', false);
    $('#pop_modal_quiz').prop('disabled', false);
}