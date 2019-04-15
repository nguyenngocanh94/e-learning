function AjaxFactory($url,  $data, $func) {
    return $.ajax({
        url: $url,
        type: 'post',
        data: $data,
        success: $func
    })
}

