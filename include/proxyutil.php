<?php
function show_403_error($error_msg, $return_url){
    $url = "/error/403.php?error_msg=" . $error_msg;
    if (isset($return_url) && !empty($return_url)){
        $url = $url . "&return_url=" . $return_url . "&error_msg=" . $error_msg;
        $url = urlencode($url);
    }
    
    header("Location: " . $url);
}
?>