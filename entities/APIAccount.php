<?php
require_once '../include/mysql.php';

class APIAccount
{
    public $name = "";
    public $api_key = '';
    public $api_secret = '';
    public $default_cnyf_address = '';
    public $active = False;

    public function __construct() {

    }
}
?>