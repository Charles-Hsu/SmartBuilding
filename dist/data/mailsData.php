<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db   = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$house_id = $_POST['id'];
$mail_num = $_POST['mail_num'];

class Msg{
    public $success='';
    public $data='';
}

if(isset($_POST['mail_num'])) {

    // 由資料庫取出目前該住戶的郵件數
    $sql = "SELECT mail_num FROM mails WHERE house_id = $house_id";
    $cur_num = intval($db->getValue($sql));
    $mail_num = intval($mail_num);

    // 更新目前該住戶的郵件數在櫃台管理員處
    $sql = "UPDATE `mails` SET `mail_num` = $mail_num WHERE house_id = $house_id";
    $msg = new Msg();

    if ($db->update($sql)) {
        $msg->success = true;
        $msg->data = 'update';
        // 如果是領取郵件, $cur_num 則大於 $mail_num, 因為 $mail_num 會少一件
        if ($cur_num > $mail_num) {
            // 更新郵件領取紀錄 mails_log
            $sql = "INSERT INTO `mails_log` (id,house_id,dd) VALUES (NULL, $house_id, '" . date('Y-m-d') . "')";
            // echo $sql;
            $db->insert($sql);
        }
    }
    else {
        $msg->success = false;
        $msg->data = 'reject';
    }


}

echo json_encode($msg);