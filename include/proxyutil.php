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

function member_check_signature_is_valid($api_key, $api_secret, $externaluserId, $original_signature){
    $str_to_be_signed = "api_key=" . $api_key . "&externaluserId=" . $externaluserId;
    $str_to_be_signed = $str_to_be_signed . "&secret=" . $api_secret;
    $signature = md5($str_to_be_signed);
    error_log("member_check_signature_is_valid(): md5(" . $str_to_be_signed . ")=" . $signature . " the original signature=" . $original_signature);

    return $signature == $original_signature;
}

function update_qrcode_signature_is_valid($api_key, $api_secret, $auth_token, $auth_check_url, $externaluserId, $weixin, $original_signature){
    $str_to_be_signed = "api_key=" . $api_key;
    $str_to_be_signed = $str_to_be_signed . "&auth_token=" . $auth_token;
	$str_to_be_signed = $str_to_be_signed . "&auth_check_url=" . $auth_check_url;
	$str_to_be_signed = $str_to_be_signed . "&externaluserId=" . $externaluserId;
	$str_to_be_signed = $str_to_be_signed . "&weixin=" . $weixin;
    $str_to_be_signed = $str_to_be_signed . "&secret=" . $api_secret;
    $signature = md5($str_to_be_signed);
    error_log("update_qrcode_signature_is_valid(): md5(" . $str_to_be_signed . ")=" . $signature . " the original signature=" . $original_signature);
    return $signature == $original_signature;
}

function redeem_signature_is_valid($api_key, $api_secret, $externaluserId, $external_cnyf_address, $redeem_amount, $txid, $original_signature){
	$str_to_be_signed = "api_key=" . $api_key . "auth_token=". $auth_token;
	$str_to_be_signed = $str_to_be_signed . "auth_check_url=". $auth_check_url;
	$str_to_be_signed = $str_to_be_signed . "&externaluserId=" . $externaluserId;
    $str_to_be_signed = $str_to_be_signed . "&external_cny_rec_address=" . $external_cnyf_address;
    $str_to_be_signed = $str_to_be_signed . "&redeem_amount=" . $redeem_amount;
    $str_to_be_signed = $str_to_be_signed . "&txid=" . $txid;
    $str_to_be_signed = $str_to_be_signed . "&secret=" . $api_secret;
    $signature = md5($str_to_be_signed);
    error_log("redeem_signature_is_valid(): md5(" . $str_to_be_signed . ")=" . $signature . " the original signature=" . $original_signature);

    return $signature == $original_signature;
}

function paymentmethod_signature_is_valid($api_key, $api_secret, $auth_token, $auth_check_url, $externaluserId, $weixin, $return_url, $original_signature) {
	$str_to_be_signed = "api_key=" . $api_key . "auth_token=". $auth_token;
	$str_to_be_signed = $str_to_be_signed . "auth_check_url=". $auth_check_url;
	$str_to_be_signed = $str_to_be_signed . "&externaluserId=" . $externaluserId;
    $str_to_be_signed = $str_to_be_signed . "&weixin=" . $weixin;
    $str_to_be_signed = $str_to_be_signed . "&return_url=" . $return_url;
    $str_to_be_signed = $str_to_be_signed . "&secret=" . $api_secret;
    $signature = md5($str_to_be_signed);
    error_log("paymentmethod_signature_is_valid(): md5(" . $str_to_be_signed . ")=" . $signature . " the original signature=" . $original_signature);

    return $signature == $original_signature;
}

function get_url_host_part($url_host) {
    if (substr($url_host, -1) == '/') {
        return substr($url_host, 0, strlen($url_host) - 1);
    } else {
        return $url_host;
    }
}


function create_json_response($status, $msg, $http_resp_code = 403) {
    $resp = new \stdClass();
    $resp->status = $status;
    $resp->message = $msg;
	header('Content-Type: application/json');
	http_response_code($http_resp_code);
    echo json_encode($resp);
}

function read_proxy_parameters(&$api_key, &$return_url, &$externaluserId, &$external_cnyf_address, &$signature, &$next, $dict, $method){
    if (isset($dict['api_key'])) {
        // validate user input url
        if (empty($dict['api_key'])) {
            return "你的请求没有包含api_key";
        }
        $api_key = $dict['api_key'];

        if (!isset($dict['return_url'])) {
            return "你的请求没有包含return_url";
        }
        $return_url = $dict['return_url'];

        if (!isset($dict['externaluserId'])  || empty($dict['externaluserId'])) {
            return "你的请求没有包含你的客户的用户ID";
        }
        $externaluserId = $dict['externaluserId'];
    
        if ($method == 'GET') {
            if (!isset($dict['external_cny_rec_address'])) {
                return "你的请求没有包含你的客户的钱包地址";
            }
        }
        $external_cnyf_address = $dict['external_cny_rec_address'];

        if (!isset($dict['signature'])) {
            return "你的请求没有包含签名";
        }
        $signature = $dict['signature'];

        $next =  isset($dict['next']) ? $dict['next'] : "";

        return "OK";
    }
}


?>