<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$userId=$_POST['id'];
$curFullDate=$_POST['fulldate'];
$curFullTime=$_POST['fulltime'];
$opinionsType=$_POST['opinionstype'];


if(isset($_POST['id']) && isset($_POST['fulldate']) && isset($_POST['fulltime']) && isset($_POST['opinionstype'])){

    if($opinionsType == 'reply'){
        // 接收id 和 時間
        $sql="";
        
    }elseif($opinionsType == 'end'){
        // 接收id 和 時間
        $sql="";
    }

    // if($db->insert($sql)){
    //     $msg[0]='success';
    // }else{
    //     $msg[0]='error';
    // }

    // 模擬用
    $msg[0]='success';
    echo json_encode($msg);
}else{

}