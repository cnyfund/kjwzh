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
    $str_to_be_signed = "api_key=" . $api_key . "&externaluserId=" . $externaluserId;
    $str_to_be_signed = $str_to_be_signed . "&external_cny_rec_address=" . $external_cnyf_address;
    $str_to_be_signed = $str_to_be_signed . "&return_url=" . $return_url;
    $str_to_be_signed = $str_to_be_signed . "&secret=" . $api_secret;
    $signature = md5($str_to_be_signed);
    error_log("purchase_signature_is_valid(): md5(" . $str_to_be_signed . ")=" . $signature . " the original signature=" . $original_signature);

    return $signature == $original_signature;
}

function get_url_host_part($url_host) {
    if (substr($url_host, -1) == '/') {
        return substr($url_host, 0, strlen($url_host) - 1);
    } else {
        return $url_host;
    }
}
?>