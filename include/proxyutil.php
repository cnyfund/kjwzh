<?php
function show_proxy_error($error_code, $error_msg, $return_url){
    $url = "/error/proxyerror.php?";
    $url_param = "error_code=" . $error_code . "&error_msg=" . $error_msg;
    if (isset($return_url) && !empty($return_url)){
        $url_param = $url_param . "&return_url=" . $return_url . "&error_msg=" . $error_msg;
    }
    $url = $url . $url_param;
    
    header("Location: " . $url);
}

function purchase_signature_is_valid($api_key, $api_secret, $externaluserId, $external_cnyf_address, $return_url, $original_signature){
    return TRUE;
}
?>