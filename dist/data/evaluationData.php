<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$evaluation_points = $_POST['evaluation_points'];
$evaluation_total  = $_POST['evaluation_total'];
$eval_date = $_POST['eval_date'];
$eval_session = $_POST['eval_session'];
$eval_examinor = $_POST['eval_examinor'];
$eval_method = $_POST['eval_method'];

// INSERT INTO eval_item (`id`, `category`, `item`, `description`) VALUES (NULL, 7, 5, '社區櫃台作業流程:代辦事項')


// echo 'eval_method:' . $eval_method . '<br>';

$evaluation_points = str_replace("\\", "", $evaluation_points);

// echo 'evaluation_points:' . $evaluation_points;
// echo 'evaluation_total:' . $evaluation_total;
// echo '(eval_session:' . $eval_session . ')';


$sql = "INSERT INTO `evaluation` (`id`, `dt`, `committee`, `examinor`, `method`, `score`) VALUES (NULL, '$eval_date', '$eval_session', '$eval_examinor', '$eval_method', '$evaluation_total')";
$db->insert($sql);

$sql = "SELECT MAX(id) FROM evaluation";
$eval_id = $db->getValue($sql);

echo $eval_id;

$evaluation_points=str_replace('\\','',$evaluation_points);

$jsonB=json_decode($evaluation_points, true);

foreach($jsonB as $key => $value){
    // echo $key." => ".$value;
    // $sql = "INSERT INTO evualtion (`dt`, `committee`, `examinor`, ``";
    $sql = "INSERT INTO `eval_detail` (`id`, `eval_id`, `item`, `score`) VALUES (NULL, '$eval_id', '$key', '$value')";
    $db->insert($sql);
    echo $sql;
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