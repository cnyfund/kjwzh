<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once '../entities/UserAccount.php';
require_once '../entities/UserWallet.php';
require_once '../include/CNYFundTool.php';

if (!isset($crypto) || empty($crypto)) {
    $crypto = 'CNYF';
}

$wallet = new Wallet($db, $crypto);
$walletTool = new CNYFundTool($wallet);
error_log("process_wallet_trans: create CNYFundTool");

// list all user's wallet, remember their address and userId
$sql = "select u.id, u.h_userName, w.h_address from h_userwallet w ";
$sql .= " inner join h_member u on u.id=w.userId";

$username_to_id = array();
$wallet_to_user = array();
$rs_wallet = $db->query($sql);
if ($rs_wallet) {
    while ($row = $db->fetch_array($rs_wallet)) {
        $wallet_to_user[$row['h_address']] = $row['h_userName'];
        $username_to_id[$row['h_userName']] = $row['id'];
    }

    $rs_wallet->close();
}

$sql = "select * from `h_recharge` where h_refIdType = '" . UserAccount::WALLETDEPOSIT . "'";
$sql .= " or h_addTime >= NOW()  - INTERVAL 1 DAY";

$deposits = array();
$rs_deposits = $db->query($sql);
if ($rs_deposits) {
    while ($row = $db->fetch_array($rs_deposits)) {
        $deposits[$row['out_trade_no']] = $row['h_userName'];
    }
    $rs_deposits->close();
}

$sql = "select * from `h_recharge` where h_refIdType = '" . UserAccount::WALLETDEPOSIT . "'";
$sql .= " or h_addTime >= NOW()  - INTERVAL 1 DAY";

$deposits = array();
$rs_deposits = $db->query($sql);
if ($rs_deposits) {
    while ($row = $db->fetch_array($rs_deposits)) {
        $deposits[$row['out_trade_no']] = $row['h_userName'];
    }
    $rs_deposits->close();
}

$sql = "select * from `h_withdraw` where h_refIdType = '" . UserAccount::WALLETREDEEM . "'";
$sql .= " or h_addTime >= NOW()  - INTERVAL 1 DAY";

$redeem = array();
$rs_redeem = $db->query($sql);
if ($rs_redeem) {
    while ($row = $db->fetch_array($rs_redeem)) {
        $redeem[$row['out_trade_no']] = $row['h_userName'];
    }
    $rs_redeem->close();
}

// list transaction history from wallet
$data = $walletTool->listtransactions(UserWallet::MASTERACCOUNT, 1000);
foreach($data as $trans) {
    if ($trans["confirmations"] >= Wallet::CONFIRMATION_THRESHOLD) {
        if ($trans['category'] == 'receive') {
            if (!array_key_exist($trans['txid'], $deposit)) {
                if (array_key_exist($trans['address'], $wallet_to_user)) {
                    $user = UserAccount::load($db, $wallet_to_user[$trans['address']]);
                    $user->credit($db, $trans['amount'], $UserAccount::WALLETDEPOSIT, $trans['txid'], '');
                }
            }
        } else if ($trans['category'] == 'send') {
            if (!empty($trans['comment']) && CNYFundTool::get_userId_from_comment($trans['comment'])> 0) {
                $userId = CNYFundTool::get_userId_from_comment($trans['comment']);
                $user = UserAccount::load_by_userId($db, $userId);
                if (!array_key_exist($trans['txid'], $redeem)) {
                    error_log("User " . $user->username . " does not have txid " . $trans['txid'] . " in withdraw record");
                } else {
                    $sql = "update `h_withdraw` set ";
                    $sql .= "h_state='已打款 ";
                    $sql .= "where h_about='" . $trans['txid'] . "'";
                    @$db->query($sql);
                    $updated = $db->affected_rows();
                    if ($updated != 1) {
                        error_log("confirm wallet withdraw: Didn't find transaction id " . $trans['txid']);
                    }
                }
                

            }
        }
    
    }

}
?>
