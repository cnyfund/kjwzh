<?php
require_once '../include/mysql.php';
require_once '../entities/Wallet.php';
require_once '../include/CNYFundTool.php';

class UserWallet{
    public $userId = 0;
    public $username='';
    public $walletCrypto ='';
    public $walletAddress = '';
    public $balance = 0;
    public $lockedBalance = 0;
    public $availableBalance = 0;
    public $lastUpdatedAt = null;

    public function __construct() {
    }
    
    public function create($db, $login, $crypto) {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("Wallet::create(): Not valid dbmysql object");
            return;
        }

        if (!isset($login) || empty($login)) {
            error_log("Wallet::create(): Not valid userlogin");
            return;
        }

        if (!isset($crypto) || empty($crypto)) {
            error_log("Wallet::create(): Not valid crypto currency code");
            return;
        }

        try {
            $wallet = new Wallet($db, $crypto);
            $this->walletCrypto = $crypto;

            error_log('UserWallet:create() get wallet for '  . $crypto);

            $walletTool = new CNYFundTool($wallet);
            $this->walletAddress = $walletTool->createaddress();
            error_log("UserWallet:create(): get new address " . $this->walletAddress);

            $query = "insert into h_UserWallet set ";
            $query .= "userId=" . $this->userId . ",";
            $query .= "h_crypto='" . $this->walletCrypto. "',";
            $query .= "h_address='" . $this->walletAddress . "',";
            $query .= "h_balance=" . $this->balance . ",";
            $query .= "h_balance_locked=" . $this->lockedBalance . ",";
            $query .= "h_balance_available=" . $this->availableBalance . ",";
            $query .= "h_lastUpdatedAt='" . date('Y-m-d H:i:s') . "'";
    
            $db->query($query);
        } catch (Exception $e) {
            error_log("UserWallet::create(): Hit exception " . $e->getMessage());
        }
    }

    public function load($db, $login, $crypto) {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("Wallet::load(): Not valid dbmysql object");
            return;
        }

        if (!isset($login) || empty($login)) {
            error_log("Wallet::load(): Not valid userlogin");
            return;
        }

        if (!isset($crypto) || empty($crypto)) {
            error_log("Wallet::load(): Not valid crypto currency code");
            return;
        }
        
        try {
            $queryStr = "select u.id as userId, u.h_userName, uw.* " .
                "from h_member u inner join h_userwallet uw on u.id=uw.userId " .
                "where uw.h_crypto='{$crypto}' and u.h_userName='{$login}'";

            $rs = $db->get_one($queryStr);
            $this->userId = $rs['userId'];
            $this->username = $rs['h_userName'];
            $this->cryptoCode = $rs['h_crypto'];
            $this->walletAddress = $rs['h_address'];
            $this->balance = $rs['h_balance'];
            $this->lockedBalance = $rs['h_balance_locked'];
            $this->availableBalance = $rs['h_balance_available'];
            $this->lastUpdatedAt = $rs['h_lastUpdatedAt'];
        } catch (Exception $e) {
            error_log("UserWallet::load(): Hit exception " . $e->getMessage());
        }
    }
}

?>
