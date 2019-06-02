<!DOCTYPE html>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '首页';

require_once $_SERVER['DOCUMENT_ROOT'] . '/member/logged_data.php';
if(!$memberLogged){
	redirect('login.php');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/pager.php';


require_once 'inc_header.php';
?>
<link rel="stylesheet" type="text/css" href="/res/css/style1.css">
<script src="/res/js/public.js"></script>
<!--banner-->
<link rel="stylesheet" type="text/css" href="/res/css/responsiveslides.css">
<script src="/res/js/responsiveslides.min.js"></script>
<div class="callbacks_container">
	<ul class="rslides" id="slider">
		<li><a href="banner_xqy.html"><img src="/res/picture/pic_home_slider_1.jpg"></a></li>
		<li><a href="banner_xqy.html"><img src="/res/picture/pic_home_slider_2.jpg"></a></li>
		<li><a href="banner_xqy.html"><img src="/res/picture/pic_home_slider_3.jpg"></a></li>
		<li><a href="banner_xqy.html"><img src="/res/picture/pic_home_slider_4.jpg"></a></li>
        <li><a href="banner_xqy.html"><img src="/res/picture/pic_home_slider_4.jpg"></a></li>
    </ul>
</div>

<script type="text/javascript">
$(function () {
	// Slideshow 
	$("#slider").responsiveSlides({
		auto: true,
		pager: false,
		nav: true,
		speed: 500,
		timeout:4000,
		pager: true, 
		pauseControls: true,
		namespace: "callbacks"
	});
});
</script>
<style>

.winBox {
	float:left;
	height:40px;
	overflow:hidden;
	position:relative;
}
.scroll {
	width:100%;
	position:absolute;
	left:0px;
	top:0px;
}
.scroll li {
	width:100%;
	float:left;
	line-height:40px;
	text-align:center;
}
</style>
<!--公告-->
<div class="notice_f">
	<div class="notice_f_in">
    	<img src="/res/picture/gaogao.png"/>
  <div class="winBox">
    <ul class="scroll">
		<li><a><?php echo $webInfo['h_serviceQQ']; ?></a></li>
    </ul>
  </div>
    </div>
</div>




<script>
$(function() {
	$(".winBox").width($("body").width()-60);
    var num = 0;
    function goLeft() {
        //750是根据你给的尺寸，可变的
        if (num == -$("body").width()-50) {
            num = 0;
        }
        num -= 1;
        $(".scroll").css({
            left: num
        })
    }
    //设置滚动速度
    var timer = setInterval(goLeft, 20);
    //设置鼠标经过时滚动停止
    $(".box").hover(function() {
        clearInterval(timer);
    },
    function() {
        timer = setInterval(goLeft, 20);
    })
})
	var q=0
	var f=$(".notice_f_in ul li").length
	$(".notice_f_in ul li").first().css({display:"block"}).siblings().css({display:"none"});
	function ggds(){
		q++
		if(q==f)
		{q=0}
		$(".notice_f_in ul li").eq(q).css({display:"block"}).siblings().css({display:"none"});
		}
	setInterval(ggds,4000)
</script>

<div class="novice_f">
	<div class="novice_f_in">
    	<img src="/res/picture/cainiao.png"/>
        <h2>生产计划（未包含相应的平台提现费）</h2>
    </div>
</div>

<?php
	$query = "select * from `h_farm_shop` order by h_minMemberLevel asc,id asc";
	$result = $db->query($query);
	while($rs_list = $db->fetch_array($result))
	{
?>
<div class="novice_zs_f">
	<div class="novice_zs_f_in">
    <!--left-->
        <div class="novice_zs_f_in_l">
        	<!--top-->
            <div class="novice_zs_f_in_l_top">
            	<img src="/res/picture/biao5.png"/>
                <span><?php echo $rs_list['h_title'];?>，<?php echo $rs_list['h_life'];?>天期，年化<a href=""><?php echo $rs_list['cjfh'];?></a</span></span>
            </div>
            <!--bottom-->
            <div class="novice_zs_f_in_l_bottom">
            	<ul>
                	<li class="mark1_f">
                    	<em><?php echo $rs_list['h_money'];?>元</em>
                        <p>价格</p>
                    </li>
                    <li class="mark2_f">
                    	<em><?php echo $rs_list['h_life'];?><font>天</font></em>
                        <p>收益期限</p>
                    </li>
                    <li class="mark3_f">
                    	<em><?php echo $rs_list['h_point2Day'];?><font>元</font></em>
                        <p>每天收益</p>
                    </li>
                    <li class="mark3_f">
                    	<em><?php echo $rs_list['h_dayBuyMaxNum'];?><font>份</font></em>
                        <p>每日限购</p>
                    </li>
                </ul>
            </div>
        </div>
    <!--right-->
    	<a href="farm_shop.php?id=<?php echo $rs_list['id'];?>"><div class="novice_zs_f_in_r">
        	<span style=" background:url(/res/images/lijitoubiao.png) no-repeat center"></span>
        </div></a>
    </div>
</div>

<?php
	}
	require_once 'inc_footer.php';
?>
