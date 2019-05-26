<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

require_once '../member/logged_data.php';
require_once '../include/simple_header.php';

$pageTitle = '充值付款 - ';

$body_style ="background:#fff; margin-top:56px;";

generateHeader($pageTitle, $webInfo['h_keyword'], $webInfo['h_description']);

$amount = $_REQUEST['amount'];
$qrcode_url = $_REQUEST['payment_qrcode_url'];
?>

<body style="<?php echo $body_style; ?>">
<div class="container">
        <div class="well">
            <div class="row">
                <div class="col-sm-4">
                    <h3>充值付款二维码</h3>
                    <div id="input_purchase">
                        <table class="table">
                            <tr>
                                <td>总额<?php echo $amount; ?> CNY</td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo $qrcode_url ?>" width="300" height="400"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div>请扫描二维码跳转收款页面</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'inc_footer.php';
?>