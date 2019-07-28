<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/member/logged_data.php';


if(!$memberLogged && $webInfo['h_operationMode'] != 'PAYMENTPROXY'){
    header("Location: /member/login.php");
    exit();
}

$expire = time() + 60 * 30;
setcookie("m_username", $memberLogged_userName,$expire,'/');
setcookie("m_password", $memberLogged_passWord,$expire,'/');

function generateHeader($pageTitle, $keyword, $pageDescription) {
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
<title><?php echo $pageTitle; ?></title>
<meta name="keywords" content="<?php echo $keyword; ?>" />
<meta name="description" content="<?php echo $pageDescription; ?>" />

<script type="text/javascript" src="/ui/js/jquery.min.js"></script>
<script type="text/javascript" src="/ui/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/ui/js/bootstrap-confirmation.min.js"></script>
<script type="text/javascript" src="/ui/js/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="/ui/js/long.js"></script>
<script type="text/javascript" src="/ui/js/md5.js"></script>
<script type="text/javascript" src="/ui/js/modernizr.custom.js"></script>
<script type="text/javascript" src="/ui/js/modernizr.custom.js"></script>


<link rel="stylesheet" href="/ui/css/bootstrap.min.css">
<link href="/res/css/home.css" rel="stylesheet" type="text/css" media="all" />
<link href="/res/css/css.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="/res/css/common.css">
<link rel="stylesheet" type="text/css" href="/res/css/style1.css">

<!--[if lt IE 9]>
<script src="/ui/js/html5shiv.min.js"></script>
<script src="/ui/js/respond.min.js"></script>
<![endif]-->
</head>
<?php
}
?>