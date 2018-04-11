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
    public $success   = '';
    public $any_data  = '';
    public $att_rate  = '';
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

        $sql = "SELECT COUNT(*) as c FROM meeting_att WHERE meeting_id = $meeting_id";
        $var = $db->getRow($sql);
        $total = $var[c];
        
        $sql = "SELECT COUNT(*) as c FROM meeting_att WHERE meeting_id = $meeting_id AND dt IS NOT NULL";
        $var = $db->getRow($sql);
        $att = $var[c];
        $att_rate = number_format($att/$total*100, 1);

        $msg->att_rate = $att_rate;

        $sql = "UPDATE meetings SET att_rate='$att_rate' WHERE id='$meeting_id'";
        if(!$db->update($sql)) {
            // show error message
        }
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