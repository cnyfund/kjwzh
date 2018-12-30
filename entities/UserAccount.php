<?php
require_once '../include/mysql.php';
require_once '../entities/UserWallet.php';

class UserAccount {
    public $parentUsername = '';
    public $username = '';
    public $pwd = '';
    public $pwdII = '';
    public $regUserIP = '';

    public function __construct() {

    }

    public function create($db, $crypto = 'CNYF') {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("UserAccount::create(): Not valid dbmysql object");
            return;
        }

        try {
            
            $sql = "insert into `h_member` set ";
            $sql .= "h_parentUserName = '" . $this->parentUsername . "', ";
            $sql .= "h_userName = '" . $this->username . "', ";
            $sql .= "h_passWord = '" . $this->pwd . "', ";
            $sql .= "h_passWordII = '" . $this->pwdII . "', ";
            $sql .= "h_level = '4', ";
            $sql .= "h_isPass = '1', ";
            $sql .= "h_regTime = '" . date('Y-m-d H:i:s') . "', ";
            $sql .= "h_regIP = '" . $this->regUserIP . "' ";
            $db->query($sql);

            $rs = $db->get_one("select id from h_member where h_userName='" . $this->username . "'");

            $userwallet = new UserWallet();
            $userwallet->userId = $rs['id'];
            $userwallet->create($db, $this->username, $crypto);
    
        } catch (Exception $e) {
            error_log("UserAccount::create(): Hit exception " . $e->getMessage());            
        }
    }
}
?>