<?php
require_once '../include/conn.php';
require_once '../entities/UserAccount.php';

try {
    $member = new UserAccount();
    $member->username = $_GET['username'];
    $member->parentUsername = $_GET['parent'];
    $member->pwd= md5('123456');
    $member->pwdII= md5('654321');
    $member->regUserIP = getUserIP();

    $member->create($db);
    echo "OK" . $member->parentUsername . ' ' . $_GET['username'];
} catch (Exception $e) {
    echo "Failed: test hit exception " . $e->getMessage();
}
?>
