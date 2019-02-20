<?php
require_once '../include/mysql.php';

class Wallet{
    const CONFIRMATION_THRESHOLD = 3; 
    public $cryptoCode = '';
    public $rp = '';
    public $ru = '';
    public $port = '';
    public $wpass = '';

    public function __construct($db, $crypto) {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("Wallet::load(): Not valid dbmysql object");
            return;
        }

        if (!isset($crypto) || empty($crypto)) {
            error_log("Wallet::load(): Not valid crypto currency code");
            return;
        }

        $rs = $db->get_one("select * from h_Wallet where h_crypto='{$crypto}'");
        $this->cryptoCode = $rs['h_crypto'];
        $this->rp = $rs['h_rp'];
        $this->ru = $rs['h_ru'];
        $this->port = $rs['h_port'];
        $this->wpass = $rs['h_walletpassphrase'];
    }

} 
?>
