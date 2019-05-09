<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once '../member/logged_data.php';
require_once '../include/simple_header.php';

if(!$memberLogged){
	header("Location: " . "/member/login.php");
	exit;
}
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors= array();
    $fullname = $_POST['h_fullName'];
    $weixin = $_POST['h_weixin'];
    if (isset($_FILES['weixin_qrcode'])) {
        $file_name = $_FILES['weixin_qrcode']['name'];
        $file_size =$_FILES['weixin_qrcode']['size'];
        $file_tmp =$_FILES['weixin_qrcode']['tmp_name'];
        $file_type=$_FILES['weixin_qrcode']['type'];
        $str_array  = explode('.', $file_name);
        $str_suffix = end($str_array);
        $file_ext=strtolower($str_suffix);
        
        $extensions= array("jpeg","jpg","png");
        
        if (in_array($file_ext, $extensions)=== false) {
            $errors[] = "{$memberLogged_userName} upload weixin qrcode: {$extensions} not allowed, please choose a JPEG or PNG file.";
        }
        
        if ($file_size > 2097152) {
            $errors[]= "{$memberLogged_userName} upload weixin qrcode: File size must be less than  2 MB";
        }
    
        if (empty($errors)==true) {
            $weixin_qrcode = $memberLogged_userName . "_qrcode" . "." . $file_ext;
            move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'] . "/images/upload/weixin/".$weixin_qrcode);
        } else {
            foreach ($errors as $err) {
                error_log(err);
            }
        }
    }
    
    if(empty($errors)==true){
        $sql = "update h_member set ";
        $sql = $sql . "h_weixin = '{$weixin}',";
        $sql = $sql . "h_fullName = '{$fullname}'";
        if (isset($weixin_qrcode)) {
            $sql = $sql . ", h_weixin_qrcode = '{$weixin_qrcode}'";
        }

        $sql = $sql . " where h_userName= '{$memberLogged_userName}'";

        $db->query($sql);
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$rs = $db->get_one("select h_userName, h_weixin, h_fullName, h_weixin_qrcode from h_member where h_userName='{$memberLogged_userName}'");
	if (!$rs) {
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
	}

	$username = $rs['h_userName'];
	$fullname = $rs['h_fullName'];
	$weixin = $rs['h_weixin'];
	$weixin_qrcode = $rs['h_weixin_qrcode'];
}

$pageTitle = '支付方式 - ' . $webInfo['h_webName'] . ' - ' . '会员中心';  ;
generateHeader($pageTitle, $webInfo['h_keyword'], $webInfo['h_description']);
?>
<div class="container">
    <form class="form-horizontal" id="form_weixin" enctype="multipart/form-data" action="/member/paymentmethod.php" method="POST">
    
    <div class="row">
        <div class="form-group">
           <div class="col-sm-2"></div><div class="col-sm-6"><h3>付款方式</h3></div>
        </div>
        <div class="alert alert-success col-sm-*" role="alert" id='success_msg'></div>
        <div class="alert alert-danger col-sm-*" role="alert" id='error_msg'></div>
        <?php if (empty($rs["h_weixin_qrcode"])) {?>
        <div class="alert alert-warning col-sm-*" role="alert" id='warning_msg'>请注意，您还没有上传收款二维码，所以您还暂时不能提现。</div>
        <?php }?>
        <div class="form-group">
            <label class="control-label col-sm-2">微信昵称:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="h_weixin" name="h_weixin" value="<?php echo $weixin;?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">收款人姓名:</label>
            <div class="col-sm-6">          
                <input type="text" class="form-control" id="fullname" name="h_fullName" value="<?php echo $fullname;?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="id_weixin_qrcode">收款二维码:</label>
            <div class="controls col-sm-6">
                <input type="file" id="id_weixin_qrcode" class="filestyle" name="weixin_qrcode" />
            </div>
        </div>
        <?php if (isset($weixin_qrcode) && !empty($weixin_qrcode)) { ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="uploaded_qrcode">上传图像:</label>
            <div class="controls col-sm-6">
                <img id="uploaded_qrcode" src="/images/upload/weixin/<?php echo $weixin_qrcode;?> " width="64 " height="64 ">
            </div>
        </div>
        <?php }?>
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-large btn-primary" id="btn_save">确认</button>
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
        <?php if(empty($errors)==true){ ?>
        $("#error_msg").hide();
        <?php } else {
            ?>
        $("#error_msg").text("<?php
            echo "<ul class=\"list-group\">\n";
            foreach (errors as $err) {
                echo "  <li class=\"list-group-item list-group-item-danger\">{$err}</li>\n";
            }
            echo "</ul>\n"; ?>");
        $("error_msg").show();<?php
        }?>

        $("#warning_msg").hide();
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });

        var click_save = false;
        
        $("#btn_save").click(function () {
            if (click_save) {
                return;
            }

            var weixin = $("#h_weixin").val().trim();
            if (weixin.length == 0) {
                $("#errorTitle").text("输入错误");
                $("#errorBody").text("请输入微信昵称");
                $("#errorMessage").modal({backdrop: "static"});
                return;
            }

            var id_weixin_qrcode = $("#id_weixin_qrcode").val().trim();
            if (id_weixin_qrcode.length == 0) {
                $("#warning_msg").text("nin");
                $("#wanring_msg").show();
            }
            click_save = true;
            $("#confirmationDialog").modal("hide");
            $("#form_weixin").submit();
        });
    });

</script>

<?php
require_once 'inc_footer.php';
?>

