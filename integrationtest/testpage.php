<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/simple_header.php';


$pageTitle = '集成测试 - ';

$body_style ="background:#fff; margin-top:56px;";

generateHeader($pageTitle, $webInfo['h_keyword'], $webInfo['h_description']);

?>
<style>
.error_with_icon
{
    background-image: url('/images/error_icon.png');
    background-repeat: no-repeat;
    background-size: 28px 28px;
    padding-top: 5px;
    padding-left: 40px;  /* width of the image plus a little extra padding */
    height: 100px;
    display: block;  /* may not need this, but I've found I do */
}
</style>
<body style="<?php echo $body_style; ?>">
<div class="container" >
    <div class="row">
    <form name="integration_form" id="integration_form" class="form-horizontal" action="" method="post" >
        <input type="hidden" name="api_key" id = "api_key" value="<?php echo $PROXY_APIKEY; ?>"/>
        <input type="hidden" name="return_url" id = "return_url" value="<?php 
         if ($INTESTMODE) { echo $NOTIFYSITEDEV; } else { echo $NOTIFYSITEPROD; }
         ?>/integrationtest/testpage.php"/>
        <input type="hidden" name="signature" id = "signature" value=""/>
        <div class="form-group">
            <label for="externaluserId">UserID:</label>
            <input type="text" class="form-control" id="externaluserId" name="externaluserId">
        </div>
        <div class="form-group">
            <label for="external_cny_rec_address">User CNY Address:</label>
            <input type="text" class="form-control" id="external_cny_rec_address" name="external_cny_rec_address">
        </div>
        <div class="form-group">
            <label for="redeem_amount">Redeem Amount:</label>
            <input type="text" class="form-control" id="redeem_amount" name="redeem_amount">
        </div>
        <div class="form-group">
            <label for="txid">转币txid:</label>
            <input type="text" class="form-control" id="txid" name="txid">
        </div>
    <a href="#" id="purchase_btn" class="btn btn-info" role="button">充值</a>
    <a href="#" id="redeem_btn" class="btn btn-info" role="button">提现</a>
    </form>
 </div>
<script>
    
    $(document).ready(function(){
        $("#wait").css("display", "none");
        function disableButton(btn) {
            $(btn).prop('disabled', true);
        }
        $("#purchase_btn").click(function () {
            setTimeout(function () { disableButton("#purchase_btn"); }, 0);
            $("#integration_form").attr("action", "<?php 
            if ($INTESTMODE) { echo $NOTIFYSITEDEV; } else { echo $NOTIFYSITEPROD; } ?>/member/jincz.php");
            var uri_param = $("#api_key").val() + "&";
            uri_param = uri_param + "externaluserId=" + $("#externaluserId").val() + "&";
            uri_param = uri_param + "external_cny_rec_address=" + $("#external_cny_rec_address").val() + "&";
            uri_param = uri_param + "return_url=" + $("#return_url").val() + "&";
            var string_to_sign = uri_param + "secret=<?php echo $PROXY_SECRETKEY; ?>";
            alert('string to sign:' + string_to_sign);
            var signature  = md5(string_to_sign);
            $("#signature").val(signature);
            $("#integration_form").submit();
        });
        $("#redeem_btn").click(function () {
            setTimeout(function () { disableButton("#redeem_btn"); }, 0);
            $("#integration_form").attr("action", "<?php 
            if ($INTESTMODE) { echo $NOTIFYSITEDEV; } else { echo $NOTIFYSITEPROD; } ?>/member/jintx.php");
            var uri_param = $("#api_key").val() + "&";
            uri_param = uri_param + "amount=" + $("#redeem_amount").val() + "&" 
            uri_param = uri_param + "externaluserId=" + $("#externaluserId").val() + "&";
            uri_param = uri_param + "external_cny_rec_address=" + $("#external_cny_rec_address").val() + "&";
            uri_param = uri_param + "return_url=" + $("#return_url").val() + "&";
            uri_param = uri_param + "txid=" + $("#txid").val() + "&";
            var string_to_sign = uri_param + "secret=<?php echo $PROXY_SECRETKEY; ?>";
            alert('string to sign:' + string_to_sign);
            var signature  = md5(string_to_sign);
            $("#signature").val(signature);
            alert("请注意，用户自己的网站需要1）确保提现金额有效 2） 把提现金额的CNYF发送给指定地址（系统设置时我们会提供）3）把转币的txid记住 4）按以下例子把用户ID，提现金额，转币txid发给网关");
            alert("提现URL：" + url);

            $("#integration_form").submit();
        });
    });
</script>
</body>
</html>
