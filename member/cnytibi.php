<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '人民币钱包转账 - ';
$body_style ="background:#fff;";
require_once 'inc_header.php';
$rs = $db->get_one("select *,(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers from `h_member` a where h_userName = '{$memberLogged_userName}'");
$userWallet = $db->get_one("select * from h_memberWallet where h_username= '{$memberLogged_userName}' and h_cryptocurrency='CNY'");	

?>
<style>
.error_with_icon
{
    background-image: url('/images/error_icon.png');
    background-repeat: no-repeat;
    padding-left: 10px;  /* width of the image plus a little extra padding */
    display: block;  /* may not need this, but I've found I do */
}
</style>

<script>
function get_confirmation_text() {
    return "您将转人民币" + $('#amount').val() + "到外部钱包 " + $('#address').val() + "，请按确认键转账";
}
</script>
<div class="container">
    <h3>钱包转账</h3>
    <div class="row">
    <div class="alert alert-success col-xs-* col-sm-*" role="alert" id='success_msg'>
    </div>
    <div class="alert alert-danger col-xs-* col-sm-*" role="alert" id='error_msg'>
    </div>
    </div>
    <form class="form-horizontal" id="form_cnyredeem" >
        <div class="form-group">
        <label class="control-label col-sm-2">您的余额:</label>
        <div class="col-sm-10">
            <input type="hidden" class="form-control" id="balance" value="<?php echo $rs['h_point2'];?>" readonly>
        </div>
        </div>
        <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">转账金额:</label>
        <div class="col-sm-10">          
            <input type="text" class="form-control" id="amount" placeholder="注意有0.01元转账费用" name="amount">
        </div>
        </div>
        <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">转账地址:</label>
        <div class="col-sm-10">          
            <input type="text" class="form-control" id="address" placeholder="请输入您的外部钱包地址" name="address">
        </div>
        </div>
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-primary" id="btn_redeem" data-toggle="confirmation"
                data-btn-ok-label="确认转账" data-btn-ok-class="btn-success"
                data-btn-cancel-label="取消转账" data-btn-cancel-class="btn-default"
                data-title="转账到外部钱包" data-content="javascript(0):get_confirmation_text();">
            </div>
        </div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="errorMessage" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header alert alert danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="errorTitle"></h4>
            </div>
            <div class="modal-body">
            <span class="error_with_icon" id="errorMessage"></span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        #('#btn_redeem').click(function(){
            var amountVal= $('#amount').val();
            var amount=isNaN(amountVal)?0.0:float(amountVal);
            if (amount <= 0) {
                $("#errorTitle").val("输入错误");
                $("#errorBody").text('<p>请输入转账金额</p>');
                $("#errorMessage").modal({backdrop:"static"});
                return;
            }

            var address = $('address').val().trim();
            if (address.length < 34) {
                $("#errorTitle").val("输入错误");
                $("#errorBody").text('<p>请输入转账用的外部地址</p>');
                $("#errorMessage").modal({backdrop:"static"});
                return;                
            }

            $('#btn_redeem').confirmation({
                onConfirm: function() {
                    $.post("/member/process_cnyredeem.php",
                        $('#form_cnyredeem').serialize()
                    ).done(function(resp)) {
                        $('success_msg').val('转账成功');
                    }.fail(function(xhr, textstatus, errorThrow)){
                        $('error_msg').val('转账请求遇到错误:' + xhr.status + ' ' + errorThrow);
                    });
                },

                content: function() {
                    return "您将转人民币" + $('#amount').val() + "到外部钱包 " + $('#address').val() + "，请按确认键转账";
                },
                buttons: [
                    {
                        class: 'btn btn-primary',
                        iconClass: 'btn-success',
                        label: '确认转账'
                    },
                    {
                        class: 'btn btn-secondary',
                        iconClass: 'btn-default',
                        label: '我搞错了',
                        cancel: true
                    }
                ]
            })                
        });
    });

</script>

<?php
require_once 'inc_footer.php';
?>
