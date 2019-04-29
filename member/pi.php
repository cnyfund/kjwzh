<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/member/current_user_info.php';

$pageTitle = '支付方式 - ';
$body_style ="background:#fff;";
require_once 'inc_header.php';
?>
<div class="login_lo" style="margin-top:56px;">
	<div class="box">
    	<div class="lo_1 lo_2">
        	<span>微信昵称</span>
            <input type="text" id="x1" size="60" maxlength="60" placeholder="微信昵称" style="color:#333" value="<?php echo $current_user_info['h_fullName']?$current_user_info['h_fullName']:'汇付宝';?>" >
        </div>
		<!--<div class="lo_1 lo_2">
        	<span>收款账号</span>
            <input type="text" id="x2" size="60" maxlength="60" placeholder="您的收款账号"  style="color:#333" value="<?php echo $current_user_info['h_alipayUserName'];?>" >
        </div>-->
		<div class="lo_1 lo_2">
        	<span>收款姓名</span>
            <input type="text" id="x3" size="60" maxlength="60" style="color:#333"  placeholder="您的收款姓名" value="<?php echo $current_user_info['h_alipayFullName'];?>" >
        </div>
             
        <button type="submit" class="lo_login xiugai1_go">保存</button>
    </div>
</div>







<script>
	$("#mlindex").addClass("btn-long16");
	

	$(".xiugai1_go").click(function () {
			xiugai1_go();
			return false;
		});	
	function xiugai1_go(){
		var x1=$("#x1").val();
		var x2=$("#x2").val();
		var x3=$("#x3").val();
		var x4=$("#x4").val();
		var x5=$("#x5").val();
		var x6=$("#x6").val();
		var x7=$("#x7").val();

		if($("#x1").val()==""){
			tishi4("请填写玩家姓名",'#x1');
			return false;
			}
		if($("#x2").val()==""){
			tishi4("请填写支付宝账号",'#x2');
			return false;
			}
		if($("#x3").val()==""){
			tishi4("请填写支付宝姓名",'#x3');
			return false;
			}
		if($("#x4").val()==""){
			tishi4("请填写收货地址",'#x4');
			return false;
			}
		if($("#x5").val()==""){
			tishi4("请填写邮编",'#x5');
			return false;
			}
		if($("#x6").val()==""){
			tishi4("请填写收货人",'#x6');
			return false;
			}
		if($("#x7").val()==""){
			tishi4("请填写收货人手机",'#x7');
			return false;
			}			
		
		tishi2();
		//$.get("/member/bin.php?act=pi&fullname="+encodeURI(x1)+"&alipayUserName="+encodeURI(x2)+"&alipayFullName="+encodeURI(x3)+"&addrAddress="+encodeURI(x4)+"&addrPostcode="+encodeURI(x5)+"&addrFullName="+encodeURI(x6)+"&addrTel="+encodeURI(x7),function(e){
		$.get("/member/bin.php?act=pi&fullname="+encodeURI(x3)+"&weixin="+encodeURI(x1),function(e){
			tishi2close();
			if(e!=""){
				layer.msg(unescape(e));
				}	
			},'html');					
		}
		
	$(".xiugai2_go").click(function () {
			xiugai2_go();
			return false;
		});		
		
	function xiugai2_go(){
		var x1=$("#x21").val();
		var x2=$("#x22").val();
		var x3=$("#x23").val();
		if(!checkPwd(x1)){
			tishi4('请输入6-30位密码','#x21')
			return false;
			}
		if(!checkPwd(x2)){
			tishi4('请输入6-30位密码','#x22')
			return false;
			}		
		if(!checkPwd(x3)){
			tishi4('请输入6-30位密码','#x23')
			return false;
			}
		if(x2!=x3){
			tishi4('两次密码输入不一致','#x23')
			return false;
			}	
		tishi2();		
		$.get("/member/bin.php?act=pi_pwd&pwd="+encodeURI(x1)+"&pwd2="+encodeURI(x2)+"&pwd3="+encodeURI(x3),function(e){
			tishi2close();
			if(e!=""){
				e4 = e.substr(0,4);
				if(e4 == '更新成功'){
					layer.msg(unescape(e),function(){
						window.location.reload();
					});
				}else{
					layer.msg(unescape(e));
				}
				}	
			},'html');				
			
		}
	$(".xiugai3_go").click(function () {
			xiugai3_go();
			return false;
		});		
		
	function xiugai3_go(){
		var x1=$("#x31").val();
		var x2=$("#x32").val();
		var x3=$("#x33").val();
		if(!checkPwd(x1)){
			tishi4('请输入6-30位密码','#x31')
			return false;
			}
		if(!checkPwd(x2)){
			tishi4('请输入6-30位密码','#x32')
			return false;
			}		
		if(!checkPwd(x3)){
			tishi4('请输入6-30位密码','#x33')
			return false;
			}
		if(x2!=x3){
			tishi4('两次密码输入不一致','#x33')
			return false;
			}	
		tishi2();		
		$.get("/member/bin.php?act=pi_pwdII&pwd="+encodeURI(x1)+"&pwd2="+encodeURI(x2)+"&pwd3="+encodeURI(x3),function(e){
			tishi2close();
			if(e!=""){
				e4 = e.substr(0,4);
				if(e4 == '更新成功'){
					layer.msg(unescape(e),function(){
						window.location.reload();
					});
				}else{
					layer.msg(unescape(e));
				}
				}	
			},'html');				
			
		}
    </script>
    
<?php
require_once 'inc_footer.php';
?>
