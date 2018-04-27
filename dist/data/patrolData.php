<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$curyear  = $_POST['year'];
$curmonth = $_POST['month'];
$curday   = $_POST['day'];
$curtime  = $_POST['time'];

echo 'curyear : ' . $_POST['year'];
echo 'curmonth : ' . $_POST['month'];


if(isset($_POST['year']) && isset($_POST['month']) && isset($_POST['day']) && isset($_POST['time'])){
    $sql='INSERT SQL';
    echo $sql;

    if($db->insert($sql)){
        $msg[0]='success';
    }else{
        $msg[0]='error';
    }
    $msg[0]='success';

    echo json_encode($msg);
}else{
    // 初始化
    $sql='';

    if($db->insert($sql)){
        echo $msg[0]='success';
    }else{
        echo $msg[0]='error';
    }

    echo '';
}