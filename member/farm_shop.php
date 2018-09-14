<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '交易大厅 - ';

require_once 'inc_header.php';
?>
<style type="text/css">
<!--
.STYLE1 {color: #CCCCCC}
-->
</style>


<div class="countgo pull-left"><div class="zt">
<!--MAN -->
<div class="head">
        <a href="/member/index.php"><input type="image" class="head-icon-left" src="mod/images/common_back.png" style="border-width:0px;"></a>
        <div class="head-title">套餐购买</div>
        <a href="/member/index.php" class="head-icon-right  "></a>    </div>
<div class="remain">


<div>
<div class="remain">
  <div class="panel panel-default">

   

   
  <table class="long_table">
<tr class="tb_top">
<td></td>
<td><p>名称</p>
  </td>
<td align="center"><p>单价</p>
  <p class="STYLE1">（元）</p></td>
<td align="center">数量</td>
<td>总计</td>
</tr>

<?php
	$where = isset($_GET['id']) ? "where id={$_GET['id']}" : '';
	$query = "select * from `h_farm_shop` {$where} order by h_minMemberLevel asc,id asc";
	$result = $db->query($query);
	while($rs_list = $db->fetch_array($result))
	{
		$lifePoint2 = $rs_list['h_point2Day'] * intval($rs_list['h_life']);
			echo '<tr uid="' , $rs_list['id'] , '" vip="' , $rs_list['h_minMemberLevel'] , '">
    <td align="center" valign="middle" width="200"><img src="' , $rs_list['h_pic'] , '" style="height:100px; width:auto;"></td>
    <td><h5><strong>' , $rs_list['h_title'] , '</strong></h5>
   
    </td>
    <td valign="middle" align="center">' , $rs_list['h_money'] , '</td>
    <td valign="middle" align="center">';
    
	if($memberLogged_level >= $rs_list['h_minMemberLevel']){
		echo '<div class="input-group" style="width:130px;">
			<span class="input-group-btn"><button class="btn btn-default j_jian" type="button"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></span>
			<input type="text" class="form-control" value="0" maxlength="3" id="j_shuliang" >
			<span class="input-group-btn"><button class="btn btn-default j_jia" type="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></span>
		</div>';
	}else{
		echo '等级不足';
	}
    
	echo '</td>
    <td valign="middle" align="left" width="100"><span style="font-weight:bold;" id="j_danjia">0</span></td>
  </tr>';
	}
?>


    <tr class="tb_bottom"><td colspan='5' align="right">
<?php
$sql = "select *,(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers from `h_member` a where h_userName = '{$memberLogged_userName}' LIMIT 1";
$rs = $db->get_one($sql);
?>

    <button type="button" class="btn btn-danger" id="goumaigo">立即购买</button>
    </td>
    </tr>

</table>
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
		
	$("#goumaigo").click(function(e){
		var mejinbi=parseFloat($("#j_jinbi").text());
		if(zongshu<=0){
			tishi4('您什么都没有购买',this)
			return false;
			}
        if(mejinbi<zongjia){
			tishi4('您的余额不足',this)
			return false;
			}
		var cpidz = new Array;
		var cpslz = new Array;
		$("[id=j_shuliang]").each(function(index, element) {
			var sl=parseInt($(element).val());
			var tid=parseInt($(element).parent().parent().parent().attr("uid"));
			if(sl>0){
				cpidz.push(tid);
				cpslz.push(sl);
				}	
			});
		var url="/member/bin.php?act=farm_shop_buy&goodsIds="+cpidz.toString()+"&goodsNums="+cpslz.toString();
		tishi2();
		$.get(url,function(e){
			tishi2close();
			
			if(unescape(e)=="购买成功"){
					layer.msg('恭喜,购买成功',{shade:0.3,end:function(){
						location.reload();
						}});
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