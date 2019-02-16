<?php
require_once '../include/conn.php';
require_once '../entities/UserWallet.php';
require_once '../entities/UserAccount.php';

function test_load_non_exist_wallet($db, $username) {
    $userwallet = new UserWallet();
    try {
        $userwallet->load($db, $username, 'CNYF');
        if ($userwallet->userId > 0 && !empty($userwallet->username) && empty($userwallet->walletCrypto)) {
            echo 'test_load_non_exist_wallet() succeeded<br>';
        } else {
            echo 'test_load_non_exist_wallet() has unexpected data ' . $userwallet->userId . ' [' . 
            $userwallet->username . '] cryptoCode -' . $userwallet->walletCrypto . '-<br>';
        }

    } catch (Exception $e) {
        echo 'test_load_non_exist_wallet() hit exception ' . $e->getMessage() . '<br>';
    }
    
}


try {
    $member = new UserAccount();
    $member->username = 'USERWITHOUTWALLET';
    $member->parentUsername = '15811302702';
    $member->pwd= md5('123456');
    $member->pwdII= md5('654321');
    $member->regUserIP = getUserIP();

    $member->create($db);
    echo "OK" . $member->parentUsername . ' USERWITHOUTWALLET';
    echo 'Start the test for userwallet<br>';
    test_load_non_exist_wallet($db, $member->username);
} catch (Exception $e) {
    echo "Failed: test hit exception " . $e->getMessage();
}


?>