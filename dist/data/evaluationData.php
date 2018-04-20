<?php

header('Content-Type: application/json');
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$evaluation_points=$_POST['evaluation_points'];
$evaluation_total=$_POST['evaluation_total'];

$manage = json_decode($evaluation_points);

class Msg{
    public $success='';
    public $data='';
}

$msg=new Msg();
$msg->success=true;
$msg->data='成功';


echo json_encode($msg);