<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '激活会员 - ';

require_once 'inc_header.php';
?>

<div class="countgo pull-left"><div class="zt">
<!--MAN -->
<div class="remain">
  <div>
<ol class="breadcrumb">
  <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="/member/">主页</a></li>
  </ol>
</div>

<?php
$sql = "select *,(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers from `h_member` a where h_userName = '{$memberLogged_userName}' LIMIT 1";
$rs = $db->get_one($sql);
?>

<div class="panel panel-default">
  <div class="panel-heading">激活会员</div>
   

  <div class="panel-body">
   
   <!--主-->
   <form class="form-horizontal">
  <div class="form-group">
    <label for="x1" class="col-sm-2 control-label">您的玩家编号</label>
    <div class="col-sm-10">
      <input disabled="disabled" class="form-control form-long-w1" id="x1" placeholder="您的玩家编号" value="<?php echo $rs['h_userName'];?>">
    </div>
  </div>
  

  <div class="form-group">
    <label for="x2" class="col-sm-2 control-label"></label>
    <div class="col-sm-10"></div>
  </div>  

  <div class="form-group">
    <div class="col-sm-10"></div>
  </div> 

  <div class="form-group">
    <label for="point1UserName" class="col-sm-2 control-label">激活玩家编号</label>
    <div class="col-sm-10">
      <input class="form-control form-long-w1" id="point1UserName" placeholder="请输入需要激活的玩家编号" value="" maxlength="11">
    </div>
  </div>
  
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10" id="point1UserName-cos"></div>
  </div> 
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-warning jihuowanjia_go">激活玩家</button>
    </div>
  </div>
</form>

    <!--End-->
  </div>
   


</div>
</div>
<!--MAN End-->
</div></div>

<script>
	mgo(23);
	$('#point1UserName').bind('input propertychange', function() { 
		if(checkMobile($(this).val())){
			//tishi4('玩家编号应该是手机号码形式的11位数字','#point1UserName')
			tishi2();
			$.get("/member/bin.php?act=chkun&username="+$(this).val(),function(e){
			tishi2close();
			if(e!=""){
				$("#point1UserName-cos").html(unescape(e));
				}
			},'html');
				
			}else{
				$("#point1UserName-cos").html('');
			}
		});
	$(".jihuowanjia_go").click(function () {
			jihuowanjia_go();
			return false;
		});	
	function jihuowanjia_go(){
		if($("#point1UserName").val()==""){
			tishi4("请输入您要激活的玩家编号",'#point1UserName');
			return false;
			}
		if($("#point1UserName-cos").text().length<1){
			tishi4("请输入正确的玩家编号",'#point1UserName');
			return false;
			}
		x1=$("#point1UserName-cos").text().substr(0,5);
		if(x1!="玩家姓名："){
			tishi4($("#point1UserName-cos").text(),'#point1UserName');
			return false;
			}
		if(parseFloat($("#x2").val())<parseFloat($("#x3").val())){
			tishi4("您的激活币余额不足,无法完成激活操作",'#x2');
			return false;
			}
		//开始激活
		layer.msg("确认要激活会员"+$("#point1UserName").val()+"? 激活该用户会消费您"+$("#x3").val()+"激活币,激活成功后不可更改.",{time: 20000, btn: ['确定激活', '我点错了'],btn1: function(){jihuowanjia_go2()}});

		}
	function jihuowanjia_go2(){
		tishi2();
		$.get("/member/bin.php?act=act_mer&username="+$("#point1UserName").val(),function(e){
			tishi2close();
			if(e!=""){
					$("#point1UserName-cos").html(unescape(e));
					if($("#point1UserName-cos").text().substr(0,4)=="激活成功"){
						var str = "会员"+$("#point1UserName").val()+"激活成功";
						if($("#point1UserName-cos").text()!="激活成功"){
							str += '。附加消息：' + $("#point1UserName-cos").text();
						}
						layer.msg(str,{time: 20000, btn: ['确定'],btn1: function(){location.reload();}});
					}
				}	
		},'html'
		);
	}	
		
	
    </script>
    
<?php
require_once 'inc_footer.php';
?>