<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
$pageTitle = '人民币钱包充值 - ';
$body_style ="background:#fff;";
require_once 'inc_header.php';

?>
<div class="container">
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-info">
      <div class="panel-heading">钱包充值</div>
      <div class="panel-body">如果您希望将虚拟人民币充入您在本网站的钱包，请使用本站给您特设地址:<br>
      <strong>AWFrcscF7y122eaZVGpmhTX7cpwKRAtQtE</stong></div>
    </div>
  </div>
</div>
</div>
<script>
$(".lo_login").click(function () {
	layer.load(0, {time: 60*1000});
});
</script>

<!-- 弹出层部分end -->

<!--MAN End-->
<?php
require_once 'inc_footer.php';
?>