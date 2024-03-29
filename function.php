<?php
/* https://krupairost.com */
/*สามารถดูรหัส sticker package และ sticker id ได้จาก */
/* https://developers.line.biz/en/docs/messaging-api/sticker-list/ */

function line_notify($Token, $message, $sticker_package = "", $stickerId = "")
{
    $lineapi = $Token; // ใส่ token key ที่ได้มา
    // $mms =  trim($message); // ข้อความที่ต้องการส่ง
    if ($sticker_package == "" && $stickerId == "") {
        $mms = array(
            'message' => trim($message), // ต้องส่งข้อความด้วยเสมอ ถ้าไม่มี ให้เว้นเป็นช่องว่าง
            'stickerPackageId' => $sticker_package,
            'stickerId' => $stickerId,
        );
    } else {
        $mms = array(
            'message' => trim($message), // ต้องส่งข้อความด้วยเสมอ ถ้าไม่มี ให้เว้นเป็นช่องว่าง
        );
    }
    //กำหนดโซนและรูปแบบข้อความ
    date_default_timezone_set("Asia/Bangkok");
    $chOne = curl_init();
    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    // SSL USE 
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
    //POST 
    curl_setopt($chOne, CURLOPT_POST, 1);
    // curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms"); 
    curl_setopt($chOne, CURLOPT_POSTFIELDS, http_build_query($mms));
    curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $lineapi . '',);
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($chOne);
    //Check error 
    if (curl_error($chOne)) {
        echo 'error:' . curl_error($chOne);
    } else {
        //return ในรูปแบบ json
        $result_ = json_decode($result, true);
        return $result_;
        // echo "{ \"status\" : \"" . $result_['status'] . "\",";
        // echo "\"message\" : \"" . $result_['message'] . "\" }";
    }
    curl_close($chOne);
}
?>