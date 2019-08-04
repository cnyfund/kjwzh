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
    <form name="purchase_form" id="purchase_form" class="form-horizontal" action="http://localhost:8080/member/jincz.php" method="post" >
        <input type="hidden" name="api_key" id = "api_key" value="api_key_1234567"/>
        <input type="hidden" name="return_url" id = "return_url" value="http://localhost:8080/integrationtest/testpage.php"/>
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
            <label for="redeem_amount">转币txid:</label>
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
            var uri_param = "api_key=api_key_1234567&";
            var uri_param = uri_param + "externaluserId=" + $("#externaluserId").val() + "&";
            uri_param = uri_param + "external_cny_rec_address=" + $("#external_cny_rec_address").val() + "&";
            uri_param = uri_param + "return_url=" + "&";
            var string_to_sign = uri_param + "secret=api_secret_1234567";
            alert('string to sign:' + string_to_sign);
            var signature  = md5(string_to_sign);
            $("#signature").val(signature);
            $("#purchase_form").submit();
        });
        $("#redeem_btn").click(function () {
            setTimeout(function () { disableButton("#redeem_btn"); }, 0);
            var url ="http://localhost:8080/member/jintx.php?";
            var uri_param = "externaluserId=" + $("#externaluserId").val() + "&";
            uri_param = uri_param + "return_url=http://localhost:8080/integrationtest/testpage.php" + "&";
            uri_param = uri_param + "amount=" + $("#redeem_amount") + "&";
            //uri_param = uri_param + "txid=b9fb980205af6d6cea797671fca47119b6cf996b63409c4ab50bce6e33511e87&";
            uri_param = uri_param + ""

            uri_param = uri_param + "api_key=1234567890";
            var string_to_sign = uri_param + "secret=0987654321";
            var signature  = md5(encodeURI(string_to_sign));
            url = url + "&signature=" + signature;

            alert("请注意，用户自己的网站需要1）确保提现金额有效 2） 把提现金额的CNYF发送给指定地址（系统设置时我们会提供）3）把转币的txid记住 4）按以下例子把用户ID，提现金额，转币txid发给网关");
            alert("提现URL：" + url);

            window.location.href=url;
        });
    });
</script>
</body>
</html>