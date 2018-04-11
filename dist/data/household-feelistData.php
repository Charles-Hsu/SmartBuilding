<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$recordId = $_POST['recordId'];

class Msg {
    public $success = '';
    public $data = '';
}
if( isset($_POST['recordId']) ) {

    $sql = "";
    
    if($db->update($sql)){
        $msg->success = true;
        $msg->data = '已繳納';
    }else{
        $msg->success = false;
    }
}
echo json_encode($msg);