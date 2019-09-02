<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/pay/pay.php';

require_once '../member/logged_data.php';
require_once '../entities/UserAccount.php';

$pageTitle = '我要提现 - ';
$body_style ="background:#fff;";
require_once 'inc_header.php';

//TODO: best test it rigorously
$next = null;
$external_cnyf_address = null;

//check whether it is payment proxy related
$api_key = isset($_POST['api_key'])?$_POST['api_key']:"";
// check whether it is request of purchase submission
if (empty($api_key)) {
    // load login user if it is normal operation
    error_log("purchase: read login user normally");
    $user = UserAccount::load($db, $memberLogged_userName);
}

$errMsg = '';
$paymentUrl = '';
$amount = '';
$txid = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($api_key)) {
        // validate user input url if it is not purchase submission
        if (!isset($_POST['return_url']) || empty($_POST['return_url'])) {
			show_proxy_error("403", "你的请求没有包含return_url", null);
			return;
        }
        $return_url = $_POST['return_url'];

        if (!isset($_POST['externaluserId']) || empty($_POST['externaluserId'])) {
			show_proxy_error("403", "你的请求没有包含你的客户的用户ID", $return_url);
			return;
        }
        $userId = $_POST['externaluserId'];

        if (!isset($_POST['redeem_amount']) || empty($_POST['redeem_amount'])) {
			show_proxy_error("403", "你的请求没有包含你的客户体现金额", $return_url);
			return;
        }
        $amount = $_POST['externaluserId'];

		if (!isset($_POST['txid']) || empty($_POST['txid'])) {
			show_proxy_error("403", "你的请求没有包含你的客户的转币交易号", $return_url);
			return;
        }
        $txid = $_POST['txid'];

		if (!isset($_POST['external_cny_rec_address']) || empty($_POST['external_cny_rec_address'])) {
			show_proxy_error("403", "你的请求没有包含你的客户的钱包地址", $return_url);
			return;
        }
        $external_cnyf_address = $_POST['external_cny_rec_address'];
    
        if (!isset($_POST['signature']) || empty($_POST['signature'])) {
			show_proxy_error("403", "你的请求没有包含签名", $return_url);
			return;
        }
        $signature = $_POST['signature'];

        //now load user and see whether it exist or not, if not register the user.
        $user = UserAccount::load_api_user($db, $userId, $api_key);
        if (is_null($user)) {
			error_log("redeem: Did not find the user " . $userId . " with api_key " . $api_key . ", will register the api user");
			if (!UserAccount::create_api_user($db, $userId, $api_key, getUserIP())) {
				error_log("redeem: failed to register api_uesr with userId " . $userId . " and api_key  " . $api_key);
				show_proxy_error("500", "系统为用户" . $userId . "绑定支付出现问题，请联系客服", $return_url);
				return;
			}
			$user = UserAccount::load_api_user($db, $userId, $api_key);
			if (is_null($user)) {
				show_proxy_error("500", "系统注册用户" . $userId . "出现问题，请联系客服", $return_url);
				return;
			}
        }
        if (!redeem_signature_is_valid($user->api_account->api_key, $user->api_account->api_secret, $user->username, $external_cnyf_address, $return_url, $signature)) {
            show_proxy_error("403", "你的请求签名不符", $return_url);
            return;
        }
        // if user record does not have qrcode, then redirect to paymentmethod.php for input
        /*if (is_null($user->weixin_qrcode)) {
            $_SESSION['api_key'] = $api_key;
            $_SESSION['externaluserId'] = $externaluserId;
            $_SESSION['external_cny_rec_address'] = $external_cnyf_address;
            $_SESSION['return_url'] = (isset($return_url) && !empty($return_url)) ? $return_url: '';
            $_SESSION['signature'] = $signature;
            $_SESSION['next'] = "/member/jincz.php";

            $redirection = "/member/paymentmethod.php";
            $redirection = "Location: " . $redirection;
            error_log("purchase: user " . $user->username . " does not have payment qrcode, setup at " . $redirection);
            header($redirection);
            return;
        }*/
    }

    if (is_null($user)) {
        show_proxy_error("500", "系统找不到用户" . $userId . "，请联系客服", $return_url);
        return;
    }
}
$user = UserAccount::load($db, $memberLogged_userName);
$userwallet = UserWallet::load_by_username($db, $memberLogged_userName, 'CNYF');
if (is_null($userwallet)) {
    error_log('jintix: create new wallet for user ' . $memberLogged_userName );
    $userwallet = new UserWallet();
    $userwallet->create($db, $memberLogged_userName, 'CNYF');
}

$rs = $db->get_one("select *,(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers from `h_member` a where h_userName = '{$memberLogged_userName}'");

$filename = $_SERVER['DOCUMENT_ROOT'] . "/images/upload/weixin/" . $user->weixin_qrcode;
$ready = isset($user->weixin_qrcode) && strlen($user->weixin_qrcode)>0 && file_exists($filename);
error_log("redeem: looking for file " . $filename);

?>
<style>
.lo_1 span {
    width: 70px;
}
</style>
 <link rel="stylesheet" href="/res/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/res/layui/css/layui.mobile.css" media="all">
 <script src="/res/layui/layui.js"></script>
<div class="login_lo" style="margin-top:56px;">
	<div class="box">
	    <?php if (!$ready):?> 
	    <span>请到绑定支付上传微信收款二维码，再来进行提现</span>
			<?php else: ?>
			<span> 每次限额5000元，12小时内到账 </span>
      <?php endif ?>

    	<div class="lo_1 lo_2">
        	<span>您的余额</span>
            <input type="text" placeholder="您的余额" id="x1" value="<?php echo $rs['h_point2'];?>" size="60" maxlength="60" style="color:#333" readonly>
        </div>
		<div class="lo_1 lo_2">
        	<span>提现金额</span>
            <input type="text" placeholder="未包含相应的平台提现费" id="x2" value="" size="60" maxlength="60" style="color:#333" >
        </div>
		<div class="lo_1 lo_2">
        	<span>微信昵称</span>
            <input type="text" placeholder="开户机构" id="x5" value="<?php echo !empty($rs['h_weixin'])?$rs['h_weixin']:'汇付宝';?>" size="60" maxlength="60" style="color:#333" readonly>
        </div>
		<!--div class="lo_1 lo_2">
        	<span>收款二维码</span>
			<input name="qrcode" value="" id="qrcode" type="hidden"/>
            <button class="layui-btn layui-btn-normal layui-btn-sm" id="upload">上传收款二维码</button>
			<?php /* ALTER TABLE `h_member`
ADD COLUMN `qrcode`  varchar(255) NULL AFTER `h_jifen`;

 */?>
        </div-->
		<?php if ($ready) : ?>
		<div class="lo_2">
			<div class="layui-upload-list" id="file_box"></div>
		 </div>
        <a href="javascript:;" class="lo_login goumai_go">申请提现</a>
    </div>
	  <?php endif ?>
</div>

<script>
<?php if(empty($rs['h_alipayFullName'])){
	echo 'alert("请先绑定支付后再进行操作！");';
}?>

layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;
  var file_box = $('#file_box');
  var uploadInst = upload.render({
    elem: '#upload'
    ,url: 'upload.php'
	,exts: 'jpg|png|gif|jpeg'
	,field:'file'
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
     // obj.preview(function(index, file, result){
        //$('#demo1').attr('src', result); //图片链接（base64）
      //});
    }
    ,done: function(res){
      //如果上传失败
      if(res.code > 0){
	  }else{
        return layer.msg(res.msg);
      }
      //上传成功
	  $("#qrcode").val(res.path);
	   file_box.html('<img src="'+res.path+'" style="max-width:60%;max-height；120px"/>');
    }
    ,error: function(){
      //演示失败状态，并实现重传
      file_box.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
      file_box.find('.demo-reload').on('click', function(){
        uploadInst.upload();
      });
    }
  });
  
});
	mgo(43);
	var zhituis= <?php echo $rs['comMembers']?$rs['comMembers']:0;?>;
	$(".goumai_go").click(function () {
			goumai_go();
			//layer.msg("本功能近期开放,尽请期待!");
			return false;
		});	
	function goumai_go(){
		if(zhituis < <?php echo $webInfo['h_withdrawMinCom']; ?>){
			//alert(zhituis);
			tishi4("您的账号至少要直推<?php echo $webInfo['h_withdrawMinCom']; ?>个人才能提现",'#x1');
			return false;
			}
		if($("#x2").val()==""){
			tishi4("请输入填写提现金额",'#x2');
			return false;
			}
		if ($("#x2").val() ><?php echo $MAXREDEEM ?>) {
			  tishi4("目前阶段系统一次提现最多<?php echo $MAXREDEEM ?>元。大额提现您可以通过多次实现。");
				return false;
		 }
		if(!checkNum($("#x2").val()) || $("#x2").val()<<?php echo $webInfo['h_withdrawMinMoney']; ?>){
			tishi4("提现金额<?php echo $webInfo['h_withdrawMinMoney']; ?>元起,请输入<?php echo $webInfo['h_withdrawMinMoney']; ?>以上的整数",'#x2');
			return false;
			}


		
		if($("#x5").val()==""){
			tishi4("请输入微信昵称",'#x5');
			return false;
		}
		layer.msg("共计提现"+$("#x2").val()+"元,确认无误请点击申请提现",{time: 20000, btn: ['确定提现', '我点错了'],btn1: function(index){
                        goumai_go2();
                        layer.close(index);
                      }, 
                      btn2: function(index) {
                        layer.close(index);
                      }
                   });

		}
	function goumai_go2(){
		tishi2();
		//+"&x4="+encodeURI($("#x5").prop('checked'))
		$.get("/member/bin.php?act=point2_withdraw&num="+encodeURI($("#x2").val())+"&alipayUserName="+encodeURI($("#x3").val())+"&alipayFullName="+encodeURI($("#x4").val())+"&h_fullName="+encodeURI($("#x5").val())+"&qrcode="+encodeURI($("#qrcode").val()),function(e){
			tishi2close();
           
			if(e!=""){
				$("#x4-cos").html(unescape(e));
				if($("#x4-cos").text().substr(0,6)=="申请提现成功" || e=='申请提现成功'){
					layer.msg("申请提现成功",{end:function(){location.reload();}});
					}
          if ($("#x4-cos").text().substr(0,6)=="密码错误" || e=='密码错误'){
					   layer.msg("您输入的密码不正确，请重新输入！",{end:function(){location.reload();}});
					}else {
						layer.msg(e, {end:function(){location.reload();}});	
					}
      }else {
            layer.msg("提现返回空字符串");
      }	
		 },'html');
	}	
		
	
    </script>  
<?php
require_once 'inc_footer.php';
?>
