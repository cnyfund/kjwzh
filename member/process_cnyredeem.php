<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include//easybitcoin.php';
require_once '../entities/UserWallet.php';
require_once '../entities/UserWalletExternal.php';

try {
    $amount = (float)$_POST['amount'];
    $externalAddress = $_POST['address'];
    if (empty($externalAddress)){
        http_response_code(400);
        echo "请输入转账用的外部地址";
    } else if ($amount<=0) {
        http_response_code(400);
        echo "请输入转账金额";
    } else {
        $userwallet = UserWallet::load_by_username($conn, $memberLogged_userName, 'CNYF');
        $userwallet_external = UserWalletExternal::load_by_username($conn, $memberLogged_userName, 'CNYF');
        $cnytool = new CNYFundTool($userwallet);
        $operationComment = "POS UserId:". $userwallet->userId;
        $operationComment .= ",redeem:" . $amount;
        $operationComment .= ",to:" . $externalAddress;
        $transId = $cnytool->sendMoney($externalAddress, $amount, $operationComment);

        if (is_null($userwallet_external)) {
            $userwallet_external = new UserWalletExternal();
            $userwallet_external->userId = $memberLogged_userId;
            $userwallet_external->walletCrypto = 'CNYF';
            $userwallet_external->walletAddress = $externalAddress;
            $userwallet_external.save($conn);
        } else if (strcasecmp($userwallet_external->walletAddress, $externalAddress) != 0) {
            $userwallet_external->walletAddress = $externalAddress;
            $userwallet_external.save($conn);
        }

        echo("OK");
    }
    
}catch (Exception $e) {
    error_log("process_cnyredeem: hit exception " . $e.getMessage());
    http_response_code(500);
    echo("Error");

}
?>