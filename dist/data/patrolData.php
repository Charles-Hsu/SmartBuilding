<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$curyear  = $_POST['year'];
$curmonth = $_POST['month'];
$curday   = $_POST['day'];
$curtime  = $_POST['time'];

// echo 'curyear : '  . $_POST['year'];
// echo 'curmonth : ' . $_POST['month'];
// echo 'curday : '   . $_POST['day'];
// echo 'curtime : '  . $_POST['time'];

// $sql = "SELECT id,name FROM staff";
$sql = "SELECT a.staff_id, a.dt, a.shift, a.hours, b.name FROM shift_table a, staff b WHERE a.staff_id = b.id";

$data = $db->getRows($sql);
$ret = "";
foreach ($data AS $row) {
  if(strlen($ret) > 0)
    $ret .= ",";
  $ret .= "{\"staff_id\":\"" . $row['staff_id'] . "\",\"name\":\"". $row['name']."\", \"dt\":\"" . $row['dt'] . "\",\"shift\":\"" . $row['shift'] . "\", \"hours\":\"" . $row['hours'] . "\"}";
}
$ret = "[".$ret."]";

$id[0] = array(
  'name' => 'Charles',
  'staff_id' => 1,
  'shift_table' => array(
    array('dt' => '2018-4-01', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-04', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-12', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-13', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-14', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-18', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-19', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-20', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-21', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-23', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-24', 'shift' => 1, 'hours' => 8),
  )
);
$id[1] = array(
  'name' => 'Tony',
  'staff_id' => 2,
  'shift_table' => array(
    array('dt' => '2018-4-10', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-11', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-12', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-13', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-14', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-18', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-19', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-20', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-21', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-23', 'shift' => 1, 'hours' => 8),
    array('dt' => '2018-4-24', 'shift' => 1, 'hours' => 8),
  )
);



class Msg {
    public $success='';
    public $data='';
}
$msg = new Msg();

// echo 'type : ' . $_POST['type'];

if ($_POST['type'] === 'onwork' ) {
    $sql = 'INSERT SQL';
    // echo $sql;
    // $db->insert($sql)
    if (true) {
        $msg->success = true;
    } else {
        $msg->success = false;
    }

} else if ($_POST['type'] === 'offwork') {
    // 初始化
    $sql='';
    // $db->insert($sql)
    if (true) {
        $msg->success = true;
    } else {
        $msg->success = false;
    }
}
// echo "======json_encdoe:";
// $msg->data = $ret;
$msg->data = $id;
echo json_encode ($msg);