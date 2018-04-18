<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db   = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$house_id=$_POST['id'];
$mail_num = $_POST['mail_num'];

class Msg{
    public $success='';
    public $data='';
}

if(isset($_POST['mail_num'])){
    $sql="UPDATE `mails` SET `mail_num` = $mail_num WHERE house_id = $house_id";

    $msg=new Msg();
    if($db->update($sql)){
        $msg->success=true;
        $msg->data='update';
    }else{
        $msg->success=false;
        $msg->data='reject';
    }
}

echo json_encode($msg);