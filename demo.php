<?php
    include("function.php");
    $Token = "Change to you line token";
    $message = "Test";
    $status = line_notify($Token, $message, $sticker_package = "", $stickerId = "");
    $result_=json_decode($status, true);
    echo "{ \"status\" : \"" . $result_['status'] . "\",";
    echo "\"message\" : \"" . $result_['message'] . "\" }";
?>