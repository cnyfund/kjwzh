<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/mysql.php';

class APIAccount
{
    public $name = "";
    public $api_key = '';
    public $api_secret = '';
    public $default_cnyf_address = '';
    public $active = False;
    public $lastUpdatedAt = null;

    public function __construct() {

    }

    public static function load($db, $api_key) {
        if (!isset($db) || !($db instanceof dbmysql)) {
            error_log("APIAccount::load(): Not valid dbmysql object");
            return null;
        }

        if (empty($api_key)) {
            error_log("APIAccount::load(): api_key cannot be empty");
            return null;
        }

        error_log("APIAccount::load(" . $api_key . ")");
        $sql = "select * from h_api_member where api_key='" . $api_key . "'";
        error_log("sql=" . $sql);
        $rs = $db->get_one($sql);
        if ($rs) {
            $apiAccount = new APIAccount();
            $apiAccount->api_key = $rs['api_key'];
            $apiAccount->api_secret = $rs['api_secret'];
            $apiAccount->active = $rs['active'] == 1;
            $apiAccount->default_cnyf_address = $rs['default_cnyf_address'];
            $apiAccount->lastUpdatedAt = $rs['h_lastUpdatedAt'];
            return $apiAccount;
        } else {
            return null;
        }


    }

}
?>