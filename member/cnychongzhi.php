<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once '../member/logged_data.php';
require_once '../entities/UserWallet.php';

$pageTitle = '人民币钱包充值 - ';
$body_style ="background:#fff;";
require_once 'inc_header.php';

$userwallet = new UserWallet();
$userwallet->load($db, $memberLogged_userName, 'CNYF');
if (empty($userwallet->walletCrypto)) {
    error_log('cnychpgzhi.php: create new wallet for user {$memberLogged_userName}');
    $userwallet->create($db, 'CNYF');
    $userwallet->load($db, $memberLogged_userName, 'CNYF');
}

?>
<div class="container">
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-info">
      <div class="panel-heading">钱包充值</div>
      <div class="panel-body">如果您希望将虚拟人民币充入您在本网站的钱包，请使用本站给您特设地址:<br>
      <strong><?php echo "{$userwallet->walletAddress}"; ?></strong></div>
    </div>
  </div>
</div>
</div>

<?php
require_once 'inc_footer.php';
?>