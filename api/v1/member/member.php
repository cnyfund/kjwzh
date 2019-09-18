<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/pay/pay.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/curl_util.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/member/inc_header.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['api_key']) || !empty($_GET['api_key'])) {
        return create_json_response("ERROR_MISS_RETURNID", "你的请求没有包含API KEY");
    }
    $api_key = $_GET['api_key'];

    if (!isset($_GET['auth_token']) || empty($_GET['auth_token'])) {
        return create_json_response("ERROR_MISS_AUTHTOKEN", "你的请求没有包含登陆认证");
    }
    $auth_token = $_GET['auth_token'];
  
    if (!isset($_POST['auth_check_url']) || empty($_GET['auth_check_url'])) {
        return create_json_response("ERROR_MISS_AUTH_CHECK_URL", "你的请求没有包含登陆核实URL");
    }
    $auth_check_url = $_GET['auth_check_url'];
  
    if (!isset($_GET['externaluserId']) || empty($_GET['externaluserId'])){
        return create_json_response("ERROR_MISS_USERID", "你的请求没有包含你的客户的用户ID");
    }
    $userId = $_GET['externaluserId'];

    if (!member_check_signature_is_valid($api_key, $api_secret, $externaluserId, $original_signature)) {
        return create_json_response("ERROR_AUTH_FAILED", "你的请求签名不符");
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['api_key']) || !empty($_POST['api_key'])) {
        return create_json_response("ERROR_MISS_RETURNID", "你的请求没有包含API KEY");
    }
    $api_key = $_POST['api_key'];

    if (!isset($_POST['auth_token']) || empty($_POST['auth_token'])) {
      return create_json_response("ERROR_MISS_AUTHTOKEN", "你的请求没有包含登陆认证");
    }
    $auth_token = $_POST['auth_token'];

    if (!isset($_POST['auth_check_url']) || empty($_POST['auth_check_url'])) {
      return create_json_response("ERROR_MISS_AUTH_CHECK_URL", "你的请求没有包含登陆核实URL");
    }
    $auth_check_url = $_POST['auth_check_url'];

    if (!isset($_POST['externaluserId']) || empty($_POST['externaluserId'])){
        return create_json_response("ERROR_MISS_USERID", "你的请求没有包含你的客户的用户ID");
    }
    $userId = $_POST['externaluserId'];

    if (!isset($_POST['weixin_nickname']) || empty($_POST['weixin_nickname'])){
        return create_json_response("ERROR_MISS_WEIXIN", "你的请求没有包含微信昵称");
    }
    $weixin = $_POST['weixin_nickname'];

    if (!isset($_POST['signature']) || empty($_POST['signature'])) {
        return create_json_response("ERROR_MISS_SIGNATURE", "你的请求没有包含签名");
    }
    $signature = $_POST['signature'];
    
    if (!update_qrcode_signature_is_valid($api_key, $api_secret, $auth_token, $auth_check_url, $externaluserId, $weixin, $original_signature)) {
        return create_json_response("ERROR_AUTH_FAILED", "你的请求签名不符");
    }

    $check_url= $auth_check_url . "?token=" . url_encode($auth_token);
    try {
        curl_get($check_url, null, $response, $response_code);
        if ($response_code != 200) {
            error_log("calling " . $check_url . " return (" . $response_code . "):" . $response);
            return create_json_response("ERROR_AUTH_CHECK_FAIL", "你的请求没有通过登陆核实:(". $response_code . "):" . $response);
        }
    } catch (PayException $pe) {
        error_log("calling " . $check_url . " hit exception:" . $pe->getMessage());
        return create_json_response("ERROR_CONNECT_AUTH_CHECK_URL_FAIL", "无法链接登陆核实URL");
    }
}


//now load user and see whether it exist or not
$user = UserAccount::load_api_user($db, $userId, $api_key);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // when API user call this to check the existance of the user, we return 404 if user does
    // not exist, and we do not create user here
    if (is_null($user)) {
        return create_json_response("ERROR_USER_NOTFOUND", "你提供的用户" . $userId . "不存在", 404);
    }

    $resp->username = $user->username;
    $resp->weixin = $user->weixin;
    $url_path_getqrcode = "/api/v1/member/getqrcode.php?externaluserId=" . $resp->username . "&api_key=" . $api_key;
    $resp->weixin_qrcode = get_url_host_part($INTESTMODE ? $NOTIFYSITEPROD : $NOTIFYSITEDEV) . $url_path_getqrcode; 
    header('Content-Type: application/json');
	http_response_code(200);
    echo json_encode($resp);
    return;
}

$errors= array();
if (is_null($user)) {
    if (!UserAccount::create_api_user($db, $userId, $api_key, getUserIP())) {
        error_log("member.php: failed to register api_uesr with userId " . $userId . " and api_key  " . $api_key);
        return create_json_response("ERROR_USER_REGISTRATION", "系统注册用户" . $userId . "失败。请通知客服", 500);
    }
}

if (isset($_FILES['weixin_qrcode'])) {
    $file_name = $_FILES['weixin_qrcode']['name'];
    if (!empty($file_name)) {
        error_log("Come to save upload file {$file_name}");
        $file_size =$_FILES['weixin_qrcode']['size'];
        $file_tmp =$_FILES['weixin_qrcode']['tmp_name'];
        $file_type=$_FILES['weixin_qrcode']['type'];
        $str_array  = explode('.', $file_name);
        $str_suffix = end($str_array);
        $file_ext=strtolower($str_suffix);
    
        $extensions= array("jpeg","jpg","png");
    
        if (in_array($file_ext, $extensions)=== false) {
            $errors[] = "{$username} upload weixin qrcode: {$file_ext} not allowed, please choose a JPEG or PNG file.";
        }
    
        if ($file_size > 2097152) {
            $errors[]= "{$username} upload weixin qrcode: File size must be less than  2 MB";
        }

        if (empty($errors)==true) {
            $weixin_qrcode = $username . "_qrcode" . "." . $file_ext;
            $new_filepath = $_SERVER['DOCUMENT_ROOT'] . "/images/upload/weixin/".$weixin_qrcode;
            error_log("come to move the file to " . $new_filepath);
            move_uploaded_file($file_tmp, $new_filepath);
            $new_file_time = filemtime($new_filepath);
        } else {
            foreach ($errors as $err) {
                error_log($err);
            }
        }
    }
}

if (empty($errors)==true) {
    error_log("come to update weixin and qrcode in h_member");
    $sql = "update h_member set ";
    $sql = $sql . "h_weixin = '{$weixin}'";
    if (isset($weixin_qrcode)) {
        $sql = $sql . ", h_weixin_qrcode = '{$weixin_qrcode}'";
    }

    $sql = $sql . " where h_userName= '{$username}'";
    error_log("udpate h_member weixin: " . $sql);

    $db->query($sql);
}

?>