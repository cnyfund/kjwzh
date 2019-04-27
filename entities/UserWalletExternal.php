<?php
require_once '../include/mysql.php';
require_once '../entities/Wallet.php';
require_once '../include/CNYFundTool.php';

class UserWalletExternal {
    public $userId = 0;
    public $username = '';
    public $alias = '';
    public $walletCrypto ='';
    public $walletAddress = '';
    public $lastUpdatedAt = null;

    public function __construct() {
    }

    public static function load_by_username($db, $login, $crypto) {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("UserWalletExternal::load(): Not valid dbmysql object");
            return;
        }

        if (!isset($login) || empty($login)) {
            error_log("UserWalletExternal::load(): Not valid userlogin");
            return;
        }

        if (!isset($crypto) || empty($crypto)) {
            error_log("UserWalletExternal::load(): Not valid crypto currency code");
            return;
        }

        $query = "select u.id as uid, u.h_userName, uw.* " .
                "from h_member u inner join h_UserWalletExternal uw on u.id=uw.userId " .
                "and uw.h_crypto='{$crypto}' " .
                "where u.h_userName='{$login}'";
        $rs = $db->get_one($query);
        if ($rs) {
            error_log("Find userwalletexternal : " . $query);
            $userwallet = new UserWalletExternal();
            $userwallet->userId = $rs['uid'];
            $userwallet->alias = $rs['h_alias'];
            $userwallet->walletCrypto = $rs['h_crypto'];
            $userwallet->walletAddress = $rs['h_address'];
            $userwallet->lastUpdatedAt = $rs['h_lastUpdatedAt'];
            return $userwallet;
        }

        return null;
    }

    public function save($db) {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("Wallet::save(): Not valid dbmysql object");
            return;
        }

        if (!isset($this->userId) || $this->userId == 0) {
            error_log("UserWalletExternal::save(): No valid userId");
            return;
        }

        if (!isset($this->walletCrypto) || empty($this->walletCrypto)) {
            error_log("UserWalletExternal::save(): Not valid crypto currency code");
            return;
        }

        if (!isset($this->walletAddress) || empty($this->walletAddress)) {
            error_log("UserWalletExternal::save(): External wallet address cannot be empty");
            return;
        }

        try {
            $queryStr = "";
            if (!is_null($this->lastUpdatedAt)) {
                $queryStr .= "update from h_UserWalletExternal set ";
                $queryStr .= "h_address = '" . $this->walletAddress . "', ";
                $queryStr .= "h_alias='" . $this->alias . "'";
                $queryStr .= " where user_id=" . $this->userId;
                $queryStr .= " and lastUpdatedAt='" . date('Y-m-d H:i:s') . "'";
            } else {
                $queryStr = "insert into h_UserWalletExternal set ";
                $queryStr .= "userId=" . $this->userId . ",";
                $queryStr .= "h_crypto='" . $this->walletCrypto. "',";
                $queryStr .= "h_address='" . $this->walletAddress . "',";
                $queryStr .= "h_alias='" . $this->alias . "',";
                $queryStr .= "h_lastUpdatedAt='" . date('Y-m-d H:i:s') . "'";       
            }
            $db->query($queryStr);
            return $db->affected_rows();
        } catch (Exception $e) {
            error_log("UserWalletExternal::save(): Hit exception " . $e->getMessage());
        }
    }

    public function load($db, $crypto, $login, $address = '', $alias = '') {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("UserWalletExternal::load(): Not valid dbmysql object");
            return;
        }

        if (!isset($login) || empty($login)) {
            error_log("UserWalletExternal::load(): Not valid userlogin");
            return;
        }

        if (!isset($crypto) || empty($crypto)) {
            error_log("UserWalletExternal::load(): Not valid crypto currency code");
            return;
        }
        
        if (!isset($address) || empty($address)) {
            error_log("UserWalletExternal::load(): External address is empty");
            return;
        }
        try {
            $queryStr = "select u.id as uid, u.h_userName, uw.* " .
                "from h_member u left join h_UserWalletExternal uw on u.id=uw.userId " .
                "and uw.h_crypto='{$crypto}' " .
                "where u.h_userName='{$login}'";

            if (isset($address) && !empty($address)) {
                $queryStr = $queryStr .  " and uw.address='{$address}'";
            }
            if (isset($alias) && !empty($alias)) {
                $queryStr = $queryStr . " and uw.h_alias='" . $alias . "'";
            }

            // echo 'quyer is ' . $queryStr;
            $rs = $db->get_one($queryStr);
            if ($rs) {
                $this->userId = $rs['uid'];
                $this->alias = $rs['h_alias'];
                $this->walletCrypto = $rs['h_crypto'];
                $this->walletAddress = $rs['h_address'];
                $this->lastUpdatedAt = $rs['h_lastUpdatedAt'];    
            }
        } catch (Exception $e) {
            error_log("UserWalletExternal::load(): Hit exception " . $e->getMessage());
        }
    }
}

?>
