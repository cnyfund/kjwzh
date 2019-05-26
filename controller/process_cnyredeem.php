<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once '../member/logged_data.php';
require_once '../include/CNYFundTool.php';
require_once '../entities/UserWallet.php';
require_once '../entities/UserWalletExternal.php';
require_once '../entities/UserAccount.php';

function isAddressExternal($db, $addr, $login) {
    $sql = "select w.*, m.h_userName from `h_UserWallet` w inner join `h_member` m on w.userId=m.id";
    $sql = $sql . " where w.h_address='" . $addr . "' and m.h_userName!='" . $login . "'";
    error_log("isAddressExternal(" . $addr . "," . $login . "): query " . $sql);
    $rs = $db->get_one($sql);
    return !$rs;
}
try {
    $amount = (float)$_POST['amount'];
    $externalAddress = $_POST['address'];
    if (empty($externalAddress)){
        http_response_code(400);
        echo "请输入转账用的外部地址";
    } else if ($amount<=0) {
        http_response_code(400);
        echo "请输入转账金额";
    } else if (!isAddressExternal($db, $externalAddress, $memberLogged_userName)) {
        http_response_code(400);
        echo "你输入的地址是内部钱包地址";

    } else {
        error_log("come here thinking address has no issue");

        // load user wallet and create it if it does not exist
        $userwallet = UserWallet::load_by_username($db, $memberLogged_userName, 'CNYF');
        if (is_null($userwallet)) {
            $userwallet->create($db, $memberLogged_userName, 'CNYF');
        }

        $userwallet_external = UserWalletExternal::load_by_username($db, $memberLogged_userName, 'CNYF');
        $wallet = new Wallet($db, 'CNYF');
        $cnytool = new CNYFundTool($wallet);
        $operationComment = CNYFundTool::create_redeem_comment($userwallet->userId, $amount, $externalAddress);
        error_log("about redeem: " . $operationComment);
        $transId = $cnytool->sendMoney($externalAddress, $amount, $operationComment);
        error_log("send money get : " . $transId);
        $user = UserAccount::load($db, $memberLogged_userName);
        $user->debt($db, $amount, 0.01, UserAccount::WALLETREDEEM, $transId, UserAccount::WALLETREDEEM, getUserIP());
        error_log("send money : debt user " . $user->username . " " . $amount . " fee 0.01 " . "trans Id: " . $transId);

        if (is_null($userwallet_external)) {
            error_log("send money: create user external wallet with address " . $externalAddress);
            $userwallet_external = new UserWalletExternal();
            $userwallet_external->userId = $memberLogged_userId;
            $userwallet_external->walletCrypto = 'CNYF';
            $userwallet_external->walletAddress = $externalAddress;
            $updated = $userwallet_external->save($db);
            if ($updated != 1) {
                error_log("send money: create user external address only updated " . $updated . " row");
            }
        } else if (strcasecmp($userwallet_external->walletAddress, $externalAddress) != 0) {
            error_log("send money: update user external wallet with address " . $externalAddress . " and original is " . $userwallet_external->walletAddress);
            $userwallet_external->walletAddress = $externalAddress;
            $updated = $userwallet_external->save($db);
            if ($updated != 1) {
                error_log("send money: update existing user external address only updated " . $updated . " row");
            }
        }

        echo("OK");
    }
    
}catch (Exception $e) {
    error_log("process_cnyredeem: hit exception " . $e->getMessage());
    http_response_code(500);
    echo("Error");
}
?>
