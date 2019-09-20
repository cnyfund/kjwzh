<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/entities/Wallet.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/jsonRPCClient.php';
  
class CNYFundTool {
    const USERPREFIX = "POS UserId:";
    const REDEEMPREFIX = "redeem:";
    public $cnyfundtool =  null;
    private $wpass = '';

    public static function get_wallet_account_by_user($userId) {
        return 'POS-User-'. $userId;
    }

    public static function create_redeem_comment($userId, $amount, $externalAddress) {
        $operationComment = CNYFundTool::USERPREFIX . $userId;
        $operationComment .= ",redeem:" . $amount;
        $operationComment .= ",to:" . $externalAddress;
        return $operationComment;
    }

    public static function get_userId_from_comment($comment) {
        if (empty($comment)) {
            return 0;
        }

        if (strstr($comment, CNYFundTool::USERPREFIX) != $comment) {
            return 0;
        }

        $lastpart_len = strlen(strstr($comment,','));
        $prefix_len = strlen(CNYFundTool::USERPREFIX);
        $id_str = substr($comment, $prefix_len, strlen($comment) - $prefix_len - $lastpart_len);
        return intval($id_str);
    }

    public static function get_amount_from_comment($comment) {
        if (empty($comment)) {
            return 0;
        }

        $parts = explode(",", $comment);
        if (sizeof($parts)<2) {
            error_log("get_amount_from_comment(): can't find second part of comment " . $comment);
            return 0;
        }
        $prefix_len = strlen(CNYFundTool::REDEEMPREFIX);
        $id_str = substr($parts[1], $prefix_len, strlen($parts[1]) - $prefix_len);
        return floatval($id_str);
    }

    public function __construct($wallet) {
        if (!isset($wallet) || !($wallet instanceof Wallet)) {
            error_log('Cannot create cnyfundtool with emtpy wallet object');
            return;
        }

        $this->cnyfundtool = new jsonRPCClient('http://' . $wallet->ru . ':' . $wallet->rp . '@localhost:' . $wallet->port . "/");
        $this->wpass = $wallet->wpass;
    }
    
    public function createaddress($account) {
        $rs = $this->cnyfundtool->getnewaddress($account);
        if (!$rs) {
            throw new Exception('create address failed' . $this->cnyfundtool->error . '-' . $rs);
        }

        return $rs;
    }

    public function sendmoney($address, $amount, $comment) {
        if (!empty($this->wpass)) {
            error_log("sendmoney: open wallet ...");
            $this->cnyfundtool->walletpassphrase($this->wpass, 30);
        }
        error_log("sendmoney: send to " . $address . " " . $amount);
        return $this->cnyfundtool->sendtoaddress($address, $amount, $comment);
    }

    public function listtransactions($account='', $count=10000) {
        return $this->cnyfundtool->listtransactions($account, $count);
    }
}
?>