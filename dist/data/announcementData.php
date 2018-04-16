<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db   = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
$type = $_POST['type'];
$id   = $_POST['id'];
$content = $_POST['content'];

class Msg{
    public $success='';
    public $data='';
}

if($type == "DELETE"){
    $sql="DELETE FROM `post` WHERE `id` = $id ";

    $msg=new Msg();
    if($db->delete($sql)){
        $msg->success=true;
        $msg->data='';
    }else{
        $msg->success=false;
        $msg->data='';
    }
}

if($type == "PUT"){
    $sql="UPDATE `post` set content = '$content' WHERE `id`= $id";

    $msg=new Msg();
    if($db->update($sql)){
        $msg->success=true;
        $msg->data='';
    }else{
        $msg->success=false;
        $msg->data='';
    }
}

echo json_encode($msg);