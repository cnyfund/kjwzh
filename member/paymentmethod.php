<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once '../member/logged_data.php';
require_once '../include/simple_header.php';

$rs = $db->get_one("select *,(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers from `h_member` a where h_userName = '{$memberLogged_userName}'");
$pageTitle = '支付方式 - ' . $webInfo['h_webName'] . ' - ' . '会员中心';  ;
generateHeader($pageTitle, $webInfo['h_keyword'], $webInfo['h_description']);
?>
<div class="container">
    <form class="form-horizontal" id="form_weixin" >
    <div class="row">
        <div class="form-group">
           <div class="col-sm-2"></div><div class="col-sm-6"><h3>付款方式</h3></div>
        </div>
        <div class="alert alert-success col-sm-*" role="alert" id='success_msg'></div>
        <div class="alert alert-danger col-sm-*" role="alert" id='error_msg'></div>
        <div class="form-group">
            <label class="control-label col-sm-2">微信昵称:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="h_weixin" name="h_weixin" value="<?php echo $rs['h_weixin'];?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">收款人姓名:</label>
            <div class="col-sm-6">          
                <input type="text" class="form-control" id="fullname" name="h_fullName" value="<?php echo $rs['h_fullName'];?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">收款二维码:</label>
            <div class="controls col-sm-6">
                <input type="file" id="id_weixin_qrcode" class="filestyle" name="weixin_qrcode" />
            </div>
            <?php if ($rs && $rs['h_weixin_qrcode']) { ?>
                <a href="# "><img src="/upload/weixin/<?php echo $rs['h_weixin_qrcode'];?> " width="64 " height="64 "></a>
            <?php }?>
        </div>
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-large btn-primary" id="btn_redeem">确认</button>
            </div>
        </div>
    </div>
    </form>
    <!-- Message Modal -->
    <div class="modal" id="errorMessage" role="dialog">
        <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header alert alert danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="errorTitle"></h4>
            </div>
            <div class="modal-body">
               <span class="error_with_icon" id="errorBody"></span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End Message Modal -->
    <div id="wait" style="display:none;width:64px;height:64px; position:absolute;top:50%;left:50%;padding:2px;">
         <img src='/images/Loading_blue.gif' width="50" height="50" /><br>处理中</div>
</div>
<script>
    $(document).ready(function(){
        $("#success_msg").hide();
        $("#error_msg").hide();
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });

        var click_redeemed = false;
        var click_confirmed = false;
        $("#confirmationDialog").on('show.bs.modal', function(){
            click_redeemed = true;
        });
        $("#confirmationDialog").on('hidden.bs.modal', function(){
            click_redeemed = false;
            click_confirmed = false;
        });
        
        $("#confirm_redeem").click(function () {
            if (click_confirmed) {
                return;
            }

            click_confirmed = true;
            $("#confirmationDialog").modal("hide");
            $.post("/controller/process_cnyredeem.php",
                    $("#form_cnyredeem").serialize()
                ).done(function(resp) {
                    $("#success_msg").text("转账成功");
                    $("#success_msg").show();
                }).fail(function(xhr, textstatus, errorThrow) {
                    $("#error_msg").text("转账请求遇到错误: " + xhr.status + " " + errorThrow);
                    $("#error_msg").show();
                });
        });

        $("#btn_redeem").click(function(){
            if (click_redeemed) {
                return;
            }

            $("#success_msg").hide();
            $("#error_msg").hide();
            var balance = parseFloat($("#balance").val());
            var amountVal= parseFloat($("#amount").val());
            var amount=isNaN(amountVal)?0.0:amountVal;
            if (amount <= 0) {
                $("#errorTitle").text("输入错误");
                $("#errorBody").text("请输入转账金额");
                $("#errorMessage").modal({backdrop: "static"});
                return;
            }

            var address = $("#address").val().trim();
            if (address.length < 34) {
                $("#errorTitle").text("输入错误");
                $("#errorBody").text("请输入转账用的外部地址");
                $("#errorMessage").modal({backdrop:"static"});
                return;                
            }

            if (amount - balance > 0) {
                $("#errorTitle").text("输入错误");
                $("#errorBody").text("提币金额超过您的余额");
                $("#errorMessage").modal({backdrop: "static"});
                return;                
            }

            $("#confirmation_content").text("您将转人民币" + $("#amount").val() + "到外部钱包 " + $("#address").val() + "，请按确认键转账");
            $("#confirmationDialog").modal({ backdrop: "static"});
        });
    });

</script>

<?php
require_once 'inc_footer.php';
?>

