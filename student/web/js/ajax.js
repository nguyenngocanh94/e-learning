let csrfToken = $('meta[name=csrf-token]').attr("content");
function AjaxFactory($url,  $data, $func) {
    return $.ajax({
        url: $url,
        type: 'post',
        data: $data,
        success: $func
    })
}
let popNextButton = function popNextButton() {
    $('#next_stage').prop('disabled', false);
};
setTimeout(popNextButton, $('#hidden_timeout').text());

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}