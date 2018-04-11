<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$meeting_type = $_POST['meeting_type'];

class Msg {
    public $success = '';
    public $data = '';
}
if( isset($_POST['meeting_type']) ) {

    $sql2 = "SELECT * FROM `meetings` WHERE `meeting_type` = $meeting_type";
    $data = $db->getRows($sql2);
    $msg = new Msg();
    $msg->success = true;
    
    if($data){
        $msg->data = $data;
    }else{
        $data[0]['meeting_type']=$meeting_type;
        $data[0]['round']='';
        $data[0]['session']='1';
        $msg->data = $data;
    }
}
echo json_encode($msg);