<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '我要提现 - ';
$body_style ="background:#fff;";
require_once 'inc_header.php';
$rs = $db->get_one("select *,(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers from `h_member` a where h_userName = '{$memberLogged_userName}'");
	
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
	    <span>提现功能正在修复中。对因此产生的不便，深表歉意。</span>
    	<div class="lo_1 lo_2">
        	<span>您的余额</span>
            <input type="text" placeholder="您的余额" id="x1" value="<?php echo $rs['h_point2'];?>" size="60" maxlength="60" style="color:#333" readonly>
        </div>
		<div class="lo_1 lo_2">
        	<span>提现金额</span>
            <input type="text" placeholder="未包含相应的平台提现费" id="x2" value="" size="60" maxlength="60" style="color:#333" >
        </div>
		<div class="lo_1 lo_2">
        	<span>收款账号</span>
            <input type="text" placeholder="收款<?php echo !empty($rs['h_fullName'])?$rs['h_fullName']:'汇付宝';?>账号" id="x3" value="<?php echo $rs['h_alipayUserName'];?>" size="60" maxlength="60" style="color:#333" readonly>
        </div>
		<div class="lo_1 lo_2">
        	<span>收款姓名</span>
            <input type="text" placeholder="收款账号姓名" id="x4" value="<?php echo $rs['h_alipayFullName'];?>" size="60" maxlength="60" style="color:#333" readonly>
        </div>
		<div class="lo_1 lo_2">
        	<span>开户机构</span>
            <input type="text" placeholder="开户机构" id="x5" value="<?php echo !empty($rs['h_fullName'])?$rs['h_fullName']:'汇付宝';?>" size="60" maxlength="60" style="color:#333" readonly>
        </div>
		<!--div class="lo_1 lo_2">
        	<span>收款二维码</span>
			<input name="qrcode" value="" id="qrcode" type="hidden"/>
            <button class="layui-btn layui-btn-normal layui-btn-sm" id="upload">上传收款二维码</button>
			<?php /* ALTER TABLE `h_member`
ADD COLUMN `qrcode`  varchar(255) NULL AFTER `h_jifen`;

 */?>
        </div-->
		<div class="lo_2">
			<div class="layui-upload-list" id="file_box"></div>
		 </div>
        
        <!--<a href="javascript:;" class="lo_login goumai_go">申请提现</a>-->
    </div>
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

		if(!checkNum($("#x2").val()) || $("#x2").val()<<?php echo $webInfo['h_withdrawMinMoney']; ?>){
			tishi4("提现金额<?php echo $webInfo['h_withdrawMinMoney']; ?>元起,请输入<?php echo $webInfo['h_withdrawMinMoney']; ?>以上的整数",'#x2');
			return false;
			}
		
		if($("#x3").val()==""){
			tishi4("请输入您收款用的账号",'#x3');
			return false;
			}
		if($("#x4").val()==""){
			tishi4("请输入您收款用的账号姓名",'#x4');
			return false;
			}		
		
		if($("#x5").val()==""){
			tishi4("请输入开户机构",'#x5');
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
                 if($("#x4-cos").text().substr(0,6)=="密码错误" || e=='密码错误'){
					layer.msg("您输入的密码不正确，请重新输入！",{end:function(){location.reload();}});
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
