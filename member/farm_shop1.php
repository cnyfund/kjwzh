<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '投资进场 - ';

require_once 'inc_header.php';
?>

<div class="countgo"><div class="zt">
<!--MAN -->
<div class="remain">
<div class="head">
        <a href="/member/index.php"><input type="image" class="head-icon-left" src="mod/images/common_back.png" style="border-width:0px;"></a>
        <div class="head-title">投资进场</div>
        <a href="/member/index.php" class="head-icon-right  "><img src="mod/images/home_right.png"></a>
    </div>


<div class="panel panel-default">
  <div class="panel-heading">支付购买</div>
   

   <div class="touzi_gm">
<table class="long_table">


<?php
	$query = "select * from `h_farm_shop` order by h_minMemberLevel asc,id asc";
	$result = $db->query($query);
	$i = 1;
	while($rs_list = $db->fetch_array($result))
	{
		$lifePoint2 = $rs_list['h_point2Day'] * intval($rs_list['h_life']);
			echo '<tr uid="' , $rs_list['id'] , '" vip="' , $rs_list['h_minMemberLevel'] , '">
    <td align="center" valign="middle" width="200"><img src="' , $rs_list['h_pic'] , '" style="height:100px; width:auto; padding-top:5px; padding-bottom:5px;"></td>
    <td align="center" valign="middle" width="850"><h5><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' , $rs_list['h_title'] , '</strong></h5>  
    </td>
    <td valign="middle" align="center">&nbsp;</td>
    <td valign="middle" align="center">';
    
	if($memberLogged_level >= $rs_list['h_minMemberLevel']){
		echo '<a id="goumaigo', $i ,'" data1=', $rs_list['id'] ,' data2=', $rs_list['h_money'] ,'><img src=/images/wx' , $rs_list['h_money'] , '.jpg style="height:63px; width:147px; padding-left:25px;"></a>';
	}else{
		echo '等级不足';
	}
    
	echo '</td>
    <td valign="middle" align="left" width="100"><span style="font-weight:bold;" id="j_danjia"></span></td>
  </tr>';
    $i++;
	}
?>

    <tr class="tb_bottom" style="display:none;"><td colspan='5' align="right">
<?php
$sql = "select *,(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers from `h_member` a where h_userName = '{$memberLogged_userName}' LIMIT 1";
$rs = $db->get_one($sql);
?>
    <!--<?php echo get_member_level_span($rs['h_level']);?>-->
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    您的当前元余额为:<span style="color:#C30; font-weight:bold;"><span class="glyphicon glyphicon-yen" aria-hidden="true"></span><span id="j_jinbi"><?php echo $rs['h_point2'];?></span></span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    您已选择<span id="j_zongshu"></span>个商品
    &nbsp;&nbsp;&nbsp;&nbsp;
    总价(元):<span style="color:#C30; font-weight:bold;"><span class="glyphicon glyphicon-yen" aria-hidden="true"></span><span id="j_zongjia"></span></span>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="btn btn-danger" id="goumaigo">立即购买</button>
    </td>
    </tr>

</table>
</div>
</div>
</div>
<!--MAN End-->
</div></div>

    <script>
	mgo(12);
	var zongjia=0;
	var zongshu=0;
	var myvip=0;
	kongzhi();
	$("[id=j_shuliang]").bind('input propertychange', function() {
		var sl=$(this).val();
		if(parseInt(sl)>=0 && parseInt(sl)<1000){

			}else{
			tishi4('请输入0-999之间的数字',this)
			$(this).val("0");
				}
		kongzhi();
		});
			
	$(".j_jian").click(function(e){
        jbjisuan(this,"-")
    });
	$(".j_jia").click(function(e){
        jbjisuan(this,"+")
    });
	
	function jbjisuan(t,x){
		var shuliang;
		if(x=="-"){
				shuliang=$(t).parent().next("#j_shuliang");
				shuliang.val(parseInt(shuliang.val())-1);
			}else
			{
				shuliang=$(t).parent().prev("#j_shuliang");
				shuliang.val(parseInt(shuliang.val())+1);
				}
		kongzhi();		
		//alert(shuliang.val());
		}
	
	function kongzhi(){
		zongjia=0;
		zongshu=0;
		$("[id=j_shuliang]").each(function(index, element) {
			var sl=parseInt($(element).val());
/*			var tvip=parseInt($(element).parent().parent().parent().attr("vip"));
			if(myvip<tvip){
				tishi4('您的会员等级不足,无法购买',element)
				$(element).val("0");
				return false;
				}*/
            if(sl<=0){
				$(element).prev().find(".j_jian").attr("disabled",true);
				$(element).val("0");
				}else{
				$(element).prev().find(".j_jian").attr("disabled",false);
					}
			if(sl>=999){
				$(element).next().find(".j_jia").attr("disabled",true);
				$(element).val("999");
				}else{
				$(element).next().find(".j_jia").attr("disabled",false);	
					}
			var x1=parseInt($(element).val());
			var x2=parseInt($(element).parent().parent().prev().text());
			$(element).parent().parent().next().find("#j_danjia").html(x1*x2);
			zongjia=zongjia+(x1*x2);
			zongshu=zongshu+x1;
			$("#j_zongjia").html(zongjia);
			$("#j_zongshu").html(zongshu);
        });
		}	
		
	$("#goumaigo1").click(function(e){
		var goodsIds=$(this).attr("data1");
		var goodsJiner=$(this).attr("data2");
		var url="/member/bin.php?act=farm_shop_buys&goodsIds="+goodsIds.toString()+"&goodsNums=1";
		tishi2();
		$.get(url,function(e){
			tishi2close();			
			if(unescape(e)=="ok"){
					//layer.msg('跳转中',{shade:0.3,end:function(){					
					window.location.href="/member/jinzf.php?jiner="+goodsJiner.toString();
						//}});
				}else{
					layer.msg(unescape(e));
					}
			},'html'
			);
    });
	
		$("#goumaigo2").click(function(e){
		var goodsIds=$(this).attr("data1");
		var goodsJiner=$(this).attr("data2");
		var url="/member/bin.php?act=farm_shop_buys&goodsIds="+goodsIds.toString()+"&goodsNums=1";
		tishi2();
		$.get(url,function(e){
			tishi2close();			
			if(unescape(e)=="ok"){
					//layer.msg('跳转中',{shade:0.3,end:function(){					
					window.location.href="/member/jinzf.php?jiner="+goodsJiner.toString();
						//}});
				}else{
					layer.msg(unescape(e));
					}
			},'html'
			);
    });
	
		$("#goumaigo3").click(function(e){
		var goodsIds=$(this).attr("data1");
		var goodsJiner=$(this).attr("data2");
		var url="/member/bin.php?act=farm_shop_buys&goodsIds="+goodsIds.toString()+"&goodsNums=1";
		tishi2();
		$.get(url,function(e){
			tishi2close();			
			if(unescape(e)=="ok"){
					//layer.msg('跳转中',{shade:0.3,end:function(){					
					window.location.href="/member/jinzf.php?jiner="+goodsJiner.toString();
						//}});
				}else{
					layer.msg(unescape(e));
					}
			},'html'
			);
    });
    </script>

<?php
require_once 'inc_footer.php';

?>