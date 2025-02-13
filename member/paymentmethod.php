<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/proxyutil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/member/logged_data.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/simple_header.php";

function read_proxy_parameters(&$api_key, &$return_url, &$externaluserId, &$external_cnyf_address, &$signature, &$next, $dict, $method){
    if (isset($dict['api_key'])) {
        // validate user input url
        if (empty($dict['api_key'])) {
            show_proxy_error("403", "你的请求没有包含api_key", null);
            return false;
        }
        $api_key = $dict['api_key'];

        if (!isset($dict['return_url'])) {
            show_proxy_error("403", "你的请求没有包含return_url", $return_url);
            return false;
        }
        $return_url = $dict['return_url'];

        if (!isset($dict['externaluserId'])  || empty($dict['externaluserId'])) {
            show_proxy_error("403", "你的请求没有包含你的客户的用户ID", $return_url);
            return false;
        }
        $externaluserId = $dict['externaluserId'];
    
        if ($method == 'GET') {
            if (!isset($dict['external_cny_rec_address'])) {
                show_proxy_error("403", "你的请求没有包含你的客户的钱包地址", $return_url);
                return false;
            }
        }

        $external_cnyf_address = $dict['external_cny_rec_address'];

        if (!isset($dict['signature'])) {
            show_proxy_error("403", "你的请求没有包含签名", $return_url);
            return false;
        }
        $signature = $dict['signature'];

        $next =  isset($dict['next']) ? $dict['next'] : "";

        return true;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["api_key"])) {
    if (!read_proxy_parameters($api_key, $return_url, $externaluserId, $external_cnyf_address, $signature, $next, $_POST, 'POST')){
        return;
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['api_key'])) {
    if (!read_proxy_parameters($api_key, $return_url, $externaluserId, $external_cnyf_address, $signature, $next, $_SESSION, 'GET')){
        return;
    }
} else if (!$memberLogged) {
	header("Location: " . "/member/login.php");
	exit;
}

$query = "select h_userName, h_weixin, h_fullName, h_weixin_qrcode from h_member where h_userName='";
$query = $query . ((isset($externaluserId) && !empty($externaluserId)) ? $externaluserId : $memberLogged) . "'";
$rs = $db->get_one($query);
if (!$rs) {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
}

$username = $rs['h_userName'];
$weixin = $rs['h_weixin'];
$weixin_qrcode = $rs['h_weixin_qrcode'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit_for_update']) && !empty($_POST['submit_for_update'])) {
        $errors= array();
        $weixin = $_POST['h_weixin'];
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
    }
}

$body_style ="background:#fff; margin-top:56px;";

$pageTitle = '支付方式 - ' . $webInfo['h_webName'] . ' - ' . '会员中心';  ;
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
<body style="<?php echo $body_style;?>">
<div class="container">
    <div class="row">
    <form class="form-horizontal" id="form_weixin" enctype="multipart/form-data" action="/member/paymentmethod.php" method="POST">
        <input type="hidden" id="api_key" name="api_key" value="<?php echo $api_key; ?>">
        <input type="hidden" id="externaluserId" name="externaluserId" value="<?php echo $externaluserId; ?>">
        <input type="hidden" id="external_cny_rec_address" name="external_cny_rec_address" value="<?php echo $external_cnyf_address; ?>">
        <input type="hidden" id="return_url" name="return_url" value="<?php echo $return_url; ?>">
        <input type="hidden" id="signature" name="signature" value="<?php echo $signature; ?>">
        <input type="hidden" id="next" name="next" value="<?php echo $next; ?>">
        <input type="hidden" id="submit_for_update" name="submit_for_update" value="">
        <div class="form-group">
           <div class="col-sm-2"></div><div class="col-sm-6"><h3>付款方式</h3></div>
        </div>
        <div class="alert alert-success col-sm-*" role="alert" id='success_msg'></div>
        <div class="alert alert-danger col-sm-*" role="alert" id='error_msg'></div>
        <?php if (empty($rs["h_weixin_qrcode"])) {
            if (isset($next) && !empty($next)) :?>
                <div class="alert alert-info col-sm-*" role="alert" id='warning_msg'>请先设置微信付款二维码再充值或提现。。。</div>
            <?php else :?>
                <div class="alert alert-warning col-sm-*" role="alert" id='warning_msg'>请注意，您还没有上传收款二维码，所以您还暂时不能提现。</div>
            <?php endif;?>
        <?php }?>
        <div class="form-group">
            <label class="control-label col-sm-2">微信昵称:</label><span class="asteriskField">*</span>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="h_weixin" name="h_weixin" value="<?php echo $weixin;?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="id_weixin_qrcode">收款二维码:</label>
            <div class="controls col-sm-6">
                <input type="file" id="id_weixin_qrcode" class="filestyle" name="weixin_qrcode" />
            </div>
        </div>
        <?php if (isset($weixin_qrcode) && !empty($weixin_qrcode)) { 
    
        $new_filepath = $_SERVER['DOCUMENT_ROOT'] . "/images/upload/weixin/".$weixin_qrcode;
        $new_file_time = filemtime($new_filepath);        
        ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="uploaded_qrcode">上传图像:</label>
            <div class="controls col-sm-6">
                <img id="uploaded_qrcode" src="/images/upload/weixin/<?php echo $weixin_qrcode . "?" . $new_file_time;?>" width="64 " height="64 ">
            </div>
        </div>
        <?php }?>
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-large btn-primary" id="btn_save">确认</button>
                <?php if (isset($next) && !empty($next) && isset($weixin_qrcode) && !empty($weixin_qrcode)) :?>
                <button type="button" class="btn btn-large btn-primary" id="btn_next">下一步</button>
                <?php endif; ?>
                <?php if (isset($return_url) && !empty($return_url)) :?>
                <button type="button" class="btn btn-large btn-primary" id="btn_back">返回</button>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
    </form>
    <form class="form-horizontal" id="form_next" name="form_next" enctype="multipart/form-data" action="/member/jincz.php" method="POST">
        <input type="hidden" id="api_key" name="api_key" value="<?php echo $api_key; ?>">
        <input type="hidden" id="externaluserId" name="externaluserId" value="<?php echo $externaluserId; ?>">
        <input type="hidden" id="external_cny_rec_address" name="external_cny_rec_address" value="<?php echo $external_cnyf_address; ?>">
        <input type="hidden" id="return_url" name="return_url" value="<?php echo $return_url; ?>">
        <input type="hidden" id="signature" name="signature" value="<?php echo $signature; ?>">
        <input type="hidden" id="next" name="next" value="<?php echo $next; ?>">
    </form>
    <!-- Message Modal -->
    <div class="modal" id="errorMessage" role="dialog">
        <div class="modal-dialog modal-sm">
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
        <?php } else { ?>
        $("#error_msg").text("<?php
            echo "<ul class=\"list-group\">\n";
            foreach (errors as $err) {
                echo "  <li class=\"list-group-item list-group-item-danger\">{$err}</li>\n";
            }
            echo "</ul>\n"; ?>");
        $("error_msg").show();<?php
        }?>

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
            $("#submit_for_update").val("Y");
            $("#form_weixin").submit();
        });

        if ($("#btn_next").length > 0) {
            var click_next = false;
            $("#btn_next").click(function () {
                if (click_next) {
                    return;
                }
                click_next = true;
                $("#form_next").submit();
            });
        }
        if ($("#btn_back").length > 0) {
            var click_back = false;
            $("#btn_back").click(function () {
                if (click_back) {
                    return;
                }
                click_back = true;
                window.location.href = $("#return_url").val();
            });
        }
    });
    
</script>

<?php
require_once 'inc_footer.php';
?>

