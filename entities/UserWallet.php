<?php
require_once '../include/mysql.php';
require_once '../entities/Wallet.php';
require_once '../include/CNYFundTool.php';

class UserWallet{
    const MASTERACCOUNT = '';

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

    public static function load_by_username($db, $login, $crypto) {
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
        
        $queryStr = "select u.id as uid, u.h_userName, uw.* " .
            "from h_member u inner join h_userwallet uw on u.id=uw.userId " .
            "and uw.h_crypto='{$crypto}' " .
            "where u.h_userName='{$login}'";

        // echo 'quyer is ' . $queryStr;
        $rs = $db->get_one($queryStr);
        if ($rs) {
            $wallet = new UserWallet();
            $wallet->userId = $rs['uid'];
            $wallet->username = $rs['h_userName'];
            $wallet->walletCrypto = $rs['h_crypto'];
            $wallet->walletAddress = $rs['h_address'];
            $wallet->balance = !empty($rs['h_balance'])? $rs['h_balance']: 0.0;
            $wallet->lockedBalance =!empty($rs['h_balance_locked']) ? $rs['h_balance_locked']:0.0;
            $wallet->availableBalance = !empty($rs['h_balance_available']) ? $rs['h_balance_available'] : 0.0;
            $wallet->lastUpdatedAt = $rs['h_lastUpdatedAt'];
            return $wallet;
        }

        return null;
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

        $wallet = new Wallet($db, $crypto);
        $this->walletCrypto = $crypto;

        error_log('UserWallet:create() get wallet for '  . $crypto);

        $walletTool = new CNYFundTool($wallet);
        $user_wallet_account = CNYFundTool::get_wallet_account_by_user($this->userId);
        $this->walletAddress = $walletTool->createaddress(UserWallet::MASTERACCOUNT);
        error_log("UserWallet:create(): get new address " . $this->walletAddress);

        $query = "select id, h_point2 from h_member where h_userName = '{$login}'";
        $rs = $db->get_one($query);
        if ($rs) {
            $this->id = $rs['id'];
            $this->username = $rs['h_userName'];
            $this->balance = $rs['h_point2'];
            $rs->close();
        } else {
            throw new Exception("UserWallet::create('{$login}','CNFY') could not find the user account");
        }

        $query = "insert into h_UserWallet set ";
        $query .= "userId=" . $this->userId . ",";
        $query .= "h_crypto='" . $this->walletCrypto. "',";
        $query .= "h_address='" . $this->walletAddress . "',";
        $query .= "h_balance=" . $this->balance . ",";
        $query .= "h_balance_locked=" . $this->lockedBalance . ",";
        $query .= "h_balance_available=" . $this->availableBalance . ",";
        $query .= "h_lastUpdatedAt='" . date('Y-m-d H:i:s') . "'";

        $db->query($query);
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
        
        $queryStr = "select u.id as uid, u.h_userName, u.h_point2, uw.* " .
            "from h_member u left join h_userwallet uw on u.id=uw.userId " .
            "and uw.h_crypto='{$crypto}' " .
            "where u.h_userName='{$login}'";

        // echo 'quyer is ' . $queryStr;
        $rs = $db->get_one($queryStr);
        if ($rs) {
            $this->userId = $rs['uid'];
            $this->username = $rs['h_userName'];
            $this->walletCrypto = $rs['h_crypto'];
            $this->walletAddress = $rs['h_address'];
            $this->balance = !empty($rs['h_balance'])? $rs['h_balance']: $rs['h_point2'];
            $this->lockedBalance =!empty($rs['h_balance_locked']) ? $rs['h_balance_locked']:0.0;
            $this->availableBalance = !empty($rs['h_balance_available']) ? $rs['h_balance_available'] : 0.0;
            $this->lastUpdatedAt = $rs['h_lastUpdatedAt'];    
        }
    }
}

?>
