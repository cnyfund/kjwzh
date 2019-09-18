<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/proxyutil.php';

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    return create_json_response("ERROR_BAD_METHOD", "系统只接受GETT请求");
}

if (!isset($_POST['api_key']) || !empty($_POST['api_key'])) {
    return create_json_response("ERROR_MISS_RETURNID", "你的请求没有包含API KEY");
}
$api_key = $_POST['api_key'];

if (!isset($_POST['externaluserId']) || empty($_POST['externaluserId'])){
    return create_json_response("ERROR_MISS_USERID", "你的请求没有包含你的客户的用户ID");
}
$userId = $_POST['externaluserId'];

//now load user and see whether it exist or not, return 404 if it does not
$user = UserAccount::load_api_user($db, $userId, $api_key);
if (is_null($user)) {
    error_log("getqrcode: Did not find the user " . $userId . " with api_key " . $api_key . ", will register the api user");
    return create_json_response("ERROR_USER_NOTFOUND", "你提供的用户". $userId ."不存在", 404);
}

$file_out = $_SERVER['DOCUMENT_ROOT'] . "/images/badqrcode.png";
if ($rs) {
    $file_out = $_SERVER['DOCUMENT_ROOT'] . "/images/upload/weixin/" . $user->weixin_qrcode;
} 

if (file_exists($file_out)) {

    //Set the content-type header as appropriate
    $image_info = getimagesize($file_out);
    switch ($image_info[2]) {
        case IMAGETYPE_JPEG:
            header("Content-Type: image/jpeg");
            break;
        case IMAGETYPE_GIF:
            header("Content-Type: image/gif");
            break;
        case IMAGETYPE_PNG:
            header("Content-Type: image/png");
            break;
       default:
            header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
            break;
    }

    // Set the content-length header
    header('Content-Length: ' . filesize($file_out));

    // Write the image bytes to the client
    $fp = fopen($file_out, 'rb');
    fpassthru($fp);
    exit;
}
else { // Image file not found

    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
}

?>