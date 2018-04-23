<?php

header('Content-Type: application/json');
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$evaluation_points = $_POST['evaluation_points'];
$evaluation_total  = $_POST['evaluation_total'];

$evaluation_points = str_replace("\\", "", $evaluation_points);
echo 'evaluation_points:' . $evaluation_points;
echo 'evaluation_total:' . $evaluation_total;

echo 'before:' . $manage;

$manage = json_decode($evaluation_points);

echo 'manage:' . $manage;

class Msg{
    public $success='';
    public $data='';
}

$msg=new Msg();
$msg->success=true;
$msg->data=$manage;




echo json_encode($msg);