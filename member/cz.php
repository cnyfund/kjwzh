<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/pay/pay.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/member/inc_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/proxyutil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/entities/UserAccount.php';

$pageTitle = '充值记录 - ';

$user = null;
error_log("Come to cz.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log("Come to cz.php and inside POST processor");
    if (!isset($_POST['return_url']) || empty($_POST['return_url'])) {
        show_proxy_error("403", "你的请求没有包含return_url", null);
        return;
    }

    $return_url = $_POST['return_url'];

    if (!isset($_POST['api_key']) || empty($_POST['api_key'])){
        show_proxy_error("403", "你的请求没有包含你的客户的API KEY", $return_url);
        return;
    }
    $api_key = $_POST['api_key'];

    if (!isset($_POST['externaluserId']) || empty($_POST['externaluserId'])){
        show_proxy_error("403", "你的请求没有包含你的客户的用户ID", $return_url);
        return;
    }
    $userId = $_POST['externaluserId'];

    if (!isset($_POST['external_cny_rec_address']) || empty($_POST['external_cny_rec_address'])){
        show_proxy_error("403", "你的请求没有包含你的客户的钱包地址", $return_url);
        return;
    }
    $external_cnyf_address = $_POST['external_cny_rec_address'];

    if (!isset($_POST['signature']) || empty($_POST['signature'])) {
        show_proxy_error("403", "你的请求没有包含签名", $return_url);
        return;
    }
    $signature = $_POST['signature'];

    $user = UserAccount::load_api_user($db, $userId, $api_key);
}

$userId = is_null($user) ? $memberLogged_userName : $user->username;
?>
<script language="javascript">
function goBack(){
	<?php if (isset($return_url) && !empty($return_url)):?>
	          window.location.href = "<?php echo $return_url; ?>";
	<?php else:?>
		      window.history.back();
	<?php endif; ?>
}   
    $(document).ready(function(){
		$("#btn_back").click(function () {
			goBack();
		});
		if ($("#btn_back1").length > 0) {
			$("#btn_back1").click(function(){
				goBack();
			});
		}
    });
</script>
<?php if (is_null($user)) :?>
<body>
<div class="container">
<div class="row">
<div class="alert alert-warning">您还没有充过值。请充值后再查看充值历史</div>
</div>
<div class="row">
<button type="button" class="btn btn-large btn-primary" id="btn_back">返回</button>
</div>
</div>
</body>
<?php exit; ?>
<?php endif ?>

<div class="content1">
<div class="row">
<button type="button" class="btn btn-large btn-primary" id="btn_back">返回</button>
</div>
<?php if (!isset($api_key) || empty($api_key)) :?>
<div style="background:#fff;padding:10px;width:100%;"><span style="width:100%;">您总共已充值:  <?php
    $rs = $db->get_one("select sum(h_money) as sumP from `h_recharge` where h_userName = '{$userId}' and h_state=1");
    if (strlen($rs['sumP']) <= 0) {
        $rs['sumP'] = 0;
    }
    
    echo $rs['sumP']; ?>
        </strong>元</span></div>
<?php endif; ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="info">编号</th>
				<th class="info">金额</th>
				<th class="info">方式</th>
				<th class="info">说明</th>    
				<th class="info">时间</th>
			</tr>
		</thead>
		<tbody>
<?php
// this is to provide payment qrcode url when do the listing
// in case the payment failed before and user need to re-pay
if ($INTESTMODE) {
    $payment_site = $DEVSITE;
} else {
    $payment_site = $PRODSITE;
}
list_($userId, $payment_site);
    function list_($userId, $payment_site)
    {
        global $rewriteOpen,$db;
        global $page,$total_count,$met_pageskin;
        global $mid,$mType,$mTitle,$mPageKey;
        global $cid,$cPageKey;
        global $memberLogged_userName;
        $mid = 111;
        $total_count = $db->counter('h_recharge', "h_userName = '{$userId}'", 'id');
        $page = (int)$page;
        //if($page_input){$page=$page_input;}
        $list_num = 10;
        $met_pageskin = 5;
        $rowset = new Pager($total_count, $list_num, $page);
        $from_record = $rowset->_offset();
        $query = "select r.id, r.h_state, r.h_bank, r.h_money, r.h_addTime, r.out_trade_no, r.h_reply, o.trx_bill_no  from `h_recharge` as r left join `order` as o on r.out_trade_no = o.out_trade_no where r.h_userName ='{$userId}' order by r.h_addTime desc,id desc LIMIT $from_record, $list_num";
        $result = $db->query($query);
        while ($list = $db->fetch_array($result)) {
            $rs_list[]=$list;
        }
        if ($rewriteOpen == 1) {
            $page_list = $rowset->link("/$mPageKey/page", ".html");
        } else {
            $page_list = $rowset->link(GetUrl(2) . "?page=");
        }

        if (count($rs_list) > 0) {
            foreach ($rs_list as $key=>$val) {
                if ($val['h_state']==0) {
                    if ($val['trx_bill_no']==="") {
                        $ss = '请求发送失败';
                    } else {
                        $ss='等待审核';
                    }
                }
                if ($val['h_state']==1) {
                    $ss='充值成功';
                }
                if ($val['h_state']==2) {
                    $ss='充值失败';
                }

                $pp='';
                if ($val['h_bank']==1) {
                    $pp='微信';
                }
                if ($val['h_bank']==2) {
                    $pp='支付宝';
                }
                if ($val['h_bank']==3) {
                    $pp='充币';
                }
                echo "           <tr>";
                echo "				<td>" . $val['id'] . "</td>";
                echo "				<td>" . $val['h_money'] . "</td>";
                echo "				<td>" . ($pp) . "</td>";
                if ($val['h_state']>0 || ($val['h_state'] == 0 && $val['trx_bill_no']==="")) {
                    echo "				<td>" . $ss . "<br/>" . $val['h_reply'] . "</td>";
                } else {
                    $payment_qrcode_url =  $payment_site . "/trading/payment_qrcode_url/?out_trade_no=" . $val['out_trade_no'];
                    echo "				<td><a href=\"/member/purchase_qrcode.php?amount=" . $val['h_money'] . "&payment_qrcode_url=" . urlencode($payment_qrcode_url) . "\"/>" . $ss . "</a></td>";
                }
                echo "				<td>" . $val['h_addTime'] . "</td>";
                echo "           </tr>";
            }
        } else {
            echo "<tr><td colspan=\"5\">暂无记录</td></tr>";
        }

        if (count($rs_list) > 0) {
            echo "<li>{$page_list}</li>";
        }
    } ?>
		</tbody>
	</table> 
	<div class="row">
<button type="button" class="btn btn-large btn-primary" id="btn_back1">返回</button>
</div>

<?php if (!isset($api_key) || empty($api_key)) {
    require_once 'inc_footer.php';
}?>