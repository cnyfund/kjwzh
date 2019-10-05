<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . "/include/pay/PayException.php";

function curl_get($url, $headers, &$response, &$response_code) {
    global $curl_error_codes;
    $ch = curl_init();

    // define options
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );

    if (!is_null($headers) && !empty($headers)) {
        $optArray[CURLOPT_HTTPHEADER] = $headers;
    }

    if (strpos($url, 'https:') == 0) {
        $optArray[CURLOPT_SSL_VERIFYPEER] = TRUE;
        $optArray[CURLOPT_SSL_VERIFYHOST] = 2;
    }

    // apply those options
    curl_setopt_array($ch, $optArray);

    // execute request and get response
    $response = curl_exec($ch);

    // also get the error and response code
    $errorno = curl_errno($ch);
    $errors = curl_error($ch);
    $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    //返回结果
    if (0 != $errorno) {
        $error_str = "系统出错， 请通知客服错误码: (errorno=" . $errorno . ") " . $curl_error_codes[$errorno];
        error_log($error_str);
        throw new PayException($error_str);
    }
}
?>
