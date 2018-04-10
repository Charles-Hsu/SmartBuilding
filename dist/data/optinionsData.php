<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$userId       = $_POST['id'];
$curFullDate  = $_POST['fulldate'];
$curFullTime  = $_POST['fulltime'];
$opinionsType = $_POST['opinionstype'];

if(isset($_POST['id']) && isset($_POST['fulldate']) && isset($_POST['fulltime']) && isset($_POST['opinionstype'])){

    if($opinionsType == 'reply') {
        // 接收id 和 時間 // dt_responsed
        $sql = "UPDATE opinions SET dt_responsed='$curFullDate' WHERE id ='$userId'"; 
        // echo 'reply' . $sql;
        $db->update($sql);
        
    } elseif($opinionsType == 'end') {
        // 接收id 和 時間 // dt_completed
        $sql = "UPDATE opinions SET dt_completed='$curFullDate' WHERE id ='$userId'"; 
        // echo 'end ' . $sql;
        $db->update($sql);
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