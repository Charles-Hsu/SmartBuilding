<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

class Msg{
    public $success='';
    public $data='';
}

$household_id=$_POST['household_id'];
$type=$_POST['type'];
$dt=$_POST['dt'];

if( $type == "post_res" ){
    $msg=new Msg();
    $date="'".date("Y-m-d")."'";
    $sql = "UPDATE `opinions` SET dt_responsed = $date WHERE household_id = $household_id";
    // echo $sql;

    if($db->update($sql)){

        $msg->success=true;
        $msg->data = $date;
    }else{
        $msg->success=false;
    }
}else{
    $msg=new Msg();
    $date="'".date("Y-m-d")."'";
    $sql = "UPDATE `opinions` SET dt_completed = $date WHERE household_id = $household_id";
    
    if($db->update($sql)){

        $msg->success=true;
        $msg->data = $date;
    }else{
        $msg->success=false;
    }
}

echo json_encode($msg);