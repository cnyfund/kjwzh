<?php

require_once '../entities/Wallet.php';
require_once '../include/jsonRPCClient.php';
  
class CNYFundTool {
    
    public $cnyfundtool =  null;
    private $wpass = '';

    public function __construct($wallet) {
        if (!isset($wallet) || !($wallet instanceof Wallet)) {
            error_log('Cannot create cnyfundtool with emtpy wallet object');
            return;
        }

        error_log("Construct tool have " . $wallet->ru . ", " . $wallet->rp . ", " . $wallet->port);
        $this->cnyfundtool = new jsonRPCClient('http://' . $wallet->ru . ':' . $wallet->rp . '@localhost:' . $wallet->port . "/");
        $wpass = $wallet->wpass;
    }
    
    public function createaddress($account) {
        $rs = $this->cnyfundtool->getnewaddress($account);
        if (!$rs) {
            throw new Exception('create address failed' . $this->cnyfundtool->error . '-' . $rs);
        }

        return $rs;
    }

    public function sendmoney($address, $amount, $comment) {
        if ($wpass.length > 0) {
            $this->cnyfundtool->walletpassphrase($wpass, 30);
        }
        return $this->cnyfundtool->sendtoaddress($address, $amount, $comment);
    }

    public function listtransactions() {
        return $this->cnyfundtool->listransactions('', 100000);
    }
}
?>