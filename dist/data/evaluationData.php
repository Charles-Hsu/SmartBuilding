<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$evaluation_points=$_POST['evaluation_points'];
$evaluation_total=$_POST['evaluation_total'];

$evaluation_points=str_replace('\\','',$evaluation_points);

$jsonB=json_decode($evaluation_points, true);

foreach($jsonB as $key => $value){
    echo $key." => ".$value;
}

// print_r($jsonB);


// echo $evaluation_points;



// class Msg{
//     public $success='';
//     public $data='';
// }

// $msg=new Msg();
// $msg->success=true;
// $msg->data='成功';
// echo $manage;

// echo json_encode($msg);