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
  if(strlen($ret) > 0) {
    $ret .= ",";
  }
  $ret .= "{\"staff_id\":\"" . $row['staff_id'] . "\",\"name\":\"". $row['name']."\", \"dt\":\"" . $row['dt'] . "\",\"shift\":\"" . $row['shift'] . "\", \"hours\":\"" . $row['hours'] . "\"}";
}
$ret = "[".$ret."]";

// $i=0;
$staff_array_index = 0;
$current_staff_id = -1;
// foreach ($data AS $row) {
//   // $ret .= "{\"staff_id\":\"" . $row['staff_id'] . "\",\"name\":\"". $row['name']."\", \"dt\":\"" . $row['dt'] . "\",\"shift\":\"" . $row['shift'] . "\", \"hours\":\"" . $row['hours'] . "\"}";
//   if ($id[staff_array_index]['staff_id'] != $row['staff_id']) {
//     $id[staff_array_index] = array(
//       'name' => $row['name'],
//       'staff_id' => $row['staff_id'],
//       'shift_table' => array(),
//     );
//     $current_staff_id = $row['staff_id'];
//   }
//   array_push($id[staff_array_index]['shift_table'], array('dt' => $row['dt'], 'shift' => $row['shift'], 'hours' => $row['hours']));

//   // $i++;
// }


$id[0] = array(
  'name' => 'Joe Lee',
  'staff_id' => 1,
  'shift_table' => array(
    array('dt' => '2018-4-01', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-02', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-03', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-04', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-05', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-06', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-07', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-08', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-09', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-10', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-11', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-15', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-16', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-17', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-22', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-28', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-29', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-30', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-31', 'shift' => 1, 'hours' => 12),
  )
);
$id[1] = array(
  'name' => 'Alex Wang',
  'staff_id' => 2,
  'shift_table' => array(
    array('dt' => '2018-4-1', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-2', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-3', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-4', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-5', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-6', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-7', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-12', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-13', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-14', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-18', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-19', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-20', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-21', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-23', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-24', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-25', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-26', 'shift' => 1, 'hours' => 12),
    array('dt' => '2018-4-27', 'shift' => 1, 'hours' => 12),
  )
);
$id[2] = array(
  'name' => 'Petter',
  'staff_id' => 3,
  'shift_table' => array(
    array('dt' => '2018-4-8', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-9', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-10', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-11', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-13', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-14', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-15', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-16', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-17', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-22', 'shift' => 2, 'hours' => 12),
  )
);

$id[3] = array(
  'name' => 'Charles',
  'staff_id' => 4,
  'shift_table' => array(
    array('dt' => '2018-4-12', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-18', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-19', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-20', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-21', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-23', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-24', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-25', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-26', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-27', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-28', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-29', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-30', 'shift' => 2, 'hours' => 12),
    array('dt' => '2018-4-31', 'shift' => 2, 'hours' => 12),
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