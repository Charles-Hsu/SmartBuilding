<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$curyear=$_POST['year'];
$curmonth=$_POST['month'];
$curday=$_POST['day'];
$curtime=$_POST['time'];

echo 'curyear : ' . $_POST['year'];
echo 'curmonth : ' . $_POST['month'];

class Msg{
    public $success='';
    public $data='';
}
$msg=new Msg();

if( $_POST['type'] === 'onwork' ){
    $sql='INSERT SQL';
    echo $sql;
    // $db->insert($sql)
    if(true){
        $msg->success=true;
    }else{
        $msg->success=false;
    }

}else if($_POST['type'] === 'offwork'){
    // 初始化
    $sql='';
    // $db->insert($sql)
    if(true){
        $msg->success=true;
    }else{
        $msg->success=false;
    }
}
echo json_encode($msg);