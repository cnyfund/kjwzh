<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';

$out_trade_no = $_GET['out_trade_no'];
$sql = "select u.h_weixin_qrcode from `h_member` u inner join `h_withdraw` w on u.h_userName=w.h_userName where w.out_trade_no='" . $out_trade_no . "'";

$rs = $db->get_one($sql);
$file_out = $_SERVER['DOCUMENT_ROOT'] . "/images/badqrcode.png";
if ($rs) {
    $file_out = $_SERVER['DOCUMENT_ROOT'] . "/images/upload/weixin/" . $rs['h_weixin_qrcode'];
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