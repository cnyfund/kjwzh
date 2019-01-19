<?php
require_once '../include/mysql.php';
require_once '../entities/UserWallet.php';

class UserAccount {
    const WALLETDEPOSIT ='钱包充值';
    const WALLETREDEEM = '钱包提币';
    const WALLETREDEEMFEE = '钱包提币费';
    
    public $id = 0;
    public $parentUsername = '';
    public $username = '';
    public $pwd = '';
    public $pwdII = '';
    public $regUserIP = '';
    public $lastUpdatedAt = null;

    public function __construct() {

    }

    public static function load_by_id($db, $userId) {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("UserAccount::load(): Not valid dbmysql object");
            return null;
        }

        $sql = "select * from h_member where id=" . $userId;
        $rs = $db->get_one($sql);
        if ($rs) {
            $this->id = $rs['id'];
            $this->username = $rs['h_userName'];
            $this->parentname = $rs['h_parentUserName'];
            $this->regUserIP = $rs['h_regIP'];
            $this->lastUpdatedAt = $rs['h_lastUpdatedAt'];
        }

        return $rs;
    }

    public static function load($db, $login) {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("UserAccount::load(): Not valid dbmysql object");
            return null;
        }

        if (empty($login)) {
            error_log("UserAccount::load(): login name cannot be empty");
            return null;
        }

        $sql = "select * from h_member where h_userName='" . $login . "'";
        $rs = $db->get_one($sql);
        if ($rs) {
            $this->id = $rs['id'];
            $this->username = $rs['h_userName'];
            $this->parentname = $rs['h_parentUserName'];
            $this->regUserIP = $rs['h_regIP'];
            $this->lastUpdatedAt = $rs['h_lastUpdatedAt'];
        }

        return $rs;
    }

    public function credit($db, $amount, $trans_type, $refId='', $refId_type='out_trade_no', $userIP='') {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("UserAccount::credit(): Not valid dbmysql object");
            return false;
        }
        
        if (!isset($amount) || !is_numeric($amount)) {
            error_log("UserAccount::credit(): Input amount is invalid numeric value");
            return false;
        }

        if (!isset($trans_type) || empty($trans_type)) {
            error_log("UserAccount::credit(): Input transaction type is empty");
            return false;            
        }

        $db->begin_trans();
        try {
            $sql = "update `h_member` set  h_point2 = h_point2 + {$amount}  ";
            $sql .= "where id = '{$this->id}' ";
            @$db->query($sql);

            $sql = "insert into `h_log_point2` set ";
            $sql .= "h_userName = '{$this->username}', ";
            $sql .= "h_price = '{$amount}', ";
            $sql .= "h_type = '{$trans_type}', ";
            if ($refId_type == 'out_trade_no') {
                $sql .= "h_about = '{$refId_type}:{$refId}', ";                
            } else {
                $sql .= "h_about = '{$refId}', ";
            }
            $sql .= "h_addTime =  '" . date('Y-m-d H:i:s') . "', ";
            $sql .= "h_actIP = '{$userIP}' ";
            @$db->query($sql);
            //充值记录
            $sql = "update `h_recharge` SET ";
            $sql .= "h_state = 1,h_isReturn=1, ";
            $sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
            $sql .= "h_refIdType = '" . $refId_type . "', ";
            $sql .= " where out_trade_no ='{$refId}'";
            @$db->query($sql);

            @$db->commit();

            return true;
        } catch (Exception $e) {
            error_log("Failed to credit user ${$this->username}\'s account: " . $e.getMessage());
            @$db->rollback();

            return false;
        }
    }

    public function debt($amount, $fee=0.0, $trans_type, $refId='', $refId_type='out_trade_no', $userIP='') {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("UserAccount::credit(): Not valid dbmysql object");
            return false;
        }
        
        if (!isset($amount) || !is_numeric($amount)) {
            error_log("UserAccount::credit(): Input amount is invalid numeric value");
            return false;
        }

        if (!isset($fee) || !is_numeric($fee)) {
            error_log("UserAccount::credit(): Input fee is invalid numeric value");
            return false;
        }

        if (!isset($trans_type) || empty($trans_type)) {
            error_log("UserAccount::credit(): Input transaction type is empty");
            return false;            
        }

        $db->begin_trans();
        try {
            $sql = "update `h_member` set  h_point2 = h_point2 - {$amount}  ";
            $sql .= "where id = '{$this->id}' ";
            @$db->query($sql);

            //记录扣钱
            $sql = "insert into `h_log_point2` set ";
            $sql .= "h_userName = '" . $this->username . "', ";
            $sql .= "h_price = '-" . $amount. "', ";
            $sql .= "h_type = '${$trans_type}', ";
            $sql .= "h_about = '${$refId}', ";
            $sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
            $sql .= "h_actIP = '" . $userIP . "' ";
            $db->query($sql);
            
            if ($fee > 0) {
                $sql = "insert into `h_log_point2` set ";
                $sql .= "h_userName = '" . $this->username . "', ";
                $sql .= "h_price = '-" . $fee. "', ";
                $sql .= "h_type = '" . UserAccount::WALLETREDEEMFEE . "', ";
                $sql .= "h_about = '${$refId}', ";
                $sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
                $sql .= "h_actIP = '" . $userIP . "' ";
                $db->query($sql);
            }

            $sql = "insert into `h_withdraw` set ";
            $sql .= "h_userName = '" . $this->username . "', ";
            $sql .= "h_money = '" . $amount . "', ";
            $sql .= "h_fee = '" . $fee . "', ";
            //$sql .= "h_bank = '" . $h_fullName . "', ";
            //$sql .= "h_bankFullname = '" . $alipayFullName . "', ";
            //$sql .= "h_bankCardId = '" . $alipayUserName . "', ";
            
            //$sql .= "qrcode = '" . $qrcode . "', ";
            $sql .= "h_state = '待审核', ";
            $sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
            //$sql .= "h_imgs = '" . $qrcode . "', ";
            $sql .= "out_trade_no = '" . $refId . "', ";
            $sql .= "h_refIdType = '" . $refId_type . "', ";       
            $sql .= "h_actIP = '" . $userIP . "' ";
            $db->query($sql);

            @$db->commit();
            return true;

        } catch (Exception $e) {
            error_log("Failed to debt user ${$this->username}\'s account: " . $e.getMessage());
            @$db->rollback();
            return false;
        }
        
    }

    public function confirm_withdraw($db, $trans_type, $refId, $refId_type, $status, $status_info='') {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("UserAccount::confirm_withdraw(): Not valid dbmysql object");
            return false;
        }
        
        if (!isset($trans_type) || empty($trans_type)) {
            error_log("UserAccount::confirm_withdraw(): Input transaction type is empty");
            return false;            
        }

        if (!isset($refId) || !is_numeric($refIdamount)) {
            error_log("UserAccount::confirm_withdraw(): Input transaction referenceId is empty");
            return false;
        }

        if (!isset($refId_type) || !is_numeric($refId_type)) {
            error_log("UserAccount::confirm_withdraw(): Input transaction referenceID type is empty");
            return false;
        }

        if (!isset($status) || empty($status)) {
            error_log("UserAccount::confirm_withdraw(): Input transaction type is empty");
            return false;            
        }

        $db->begin_trans();
        try{
            $sql = "update `h_withdraw` SET h_state = '{$status}' ";
            $sql .= "where out_trade_no ='{$refId}' ";
            $sql .= "and h_refIdType='${$refId_type}'";
            @$db->query($sql);

            if ($status != '已打款') {
                $rs->get_one("select * `h_withdraw` where out_trade_no = '{$refId}' and h_refIdType='${$refId_type}'");
                if ($rs) {
                    $total_fee = $rs['h_money'] + $rs['h_fee'];
                    error_log("UserAccount::confirm_withdraw(): need to revert {$rs['h_money']} with {$rs['h_fee']} for {$this->username} on refId: {$refId}");
                    $sql = "update `h_member` set";
                    $sql .= "h_point2 = h_point2 + {$total_fee}  ";
                    $sql .= "where h_userName = '{$this->username}' ";
                    @$db->query($sql);
                        
                    //记录加钱
                    $sql = "insert into `h_log_point2` set ";
                    $sql .= "h_userName = '{$this->username}', ";
                    $sql .= "h_price = '{$rtotal_fee}', ";
                    $sql .= "h_type = '{$trans_type}', ";
                    $sql .= "h_about = '{$status_info} ";
                    $sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
                    $sql .= "h_actIP = '' ";
                    @$db->query($sql);
                }
            }

            @$db->commit();
            return true;

        }catch (Exception $e) {
            error_log("Failed to confirm user ${$this->username}\'s transaction ${$refId} " . $e.getMessage());
            @$db->rollback();
            return false;            
        }

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

            //$rs = $db->get_one("select id from h_member where h_userName='" . $this->username . "'");

            //$userwallet = new UserWallet();
            //$userwallet->userId = $rs['id'];
            //$userwallet->create($db, $crypto);
    
        } catch (Exception $e) {
            error_log("UserAccount::create(): Hit exception " . $e->getMessage());            
        }
    }
}
?>