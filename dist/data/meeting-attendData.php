<?php

require '../lib/DBAccess.class.php';
require '../config/config.admin.php';

$id = $_POST['id'];
$att_id = $_POST['att_id'];
$meeting_id = $_POST['meeting_id'];
$meeting_type = $_POST['meeting_type'];
date_default_timezone_set('Asia/Taipei');

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$t = date('H:i');
$dt = date('Y-m-d H:i');

class Msg{
    public $success='';
    public $any_data='';
}

if( $meeting_type == 1 || $meeting_type == 2 ){
    $msg=new Msg();
    // echo $att_id;

    // $sql = "INSERT INTO meeting_att (`id`, `meeting_id`, `att_id`, `dt`) VALUES (NULL, $meeting_id, $att_id,'" . "$dt" . "')";
    $sql = "UPDATE meeting_att SET dt='$dt' WHERE id='$id'";
    // echo $sql;
    // $t = date_default_timezone_get();
    if($db->update($sql)) {
        // $db->insert($sql);
        $msg->success = true;
        $msg->any_data = $t;
        // $any_data = $sql;
    } else {
        $msg->success = false;
    }

} else {
    $msg=new Msg();
    $sql="";

    if(true){
        $msg->success = true;
        $msg->any_data = $t;
    }else{
        $msg->success = false;
    }
}

echo json_encode($msg);