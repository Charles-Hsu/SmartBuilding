<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$curyear=$_POST['year'];
$curmonth=$_POST['month'];

if(isset($_POST['year']) && isset($_POST['month'])){
    $sql = 'SELECT a.id AS task_id, a.dt AS dt,DAY(a.dt) AS dt_day, a.descript, b.item, c.name FROM tasks a, contract_item b, contract c WHERE a.category_id = b.id AND a.contract_id = c.id AND MONTH(a.dt) = ' . $curmonth . ' AND YEAR(a.dt) = ' . $curyear;
}else{
    $curmonth = date('m');
    $curyear = date('Y');

    $sql = 'SELECT a.id AS task_id, a.dt AS dt,DAY(a.dt) AS dt_day, a.descript, b.item, c.name FROM tasks a, contract_item b, contract c WHERE a.category_id = b.id AND a.contract_id = c.id AND MONTH(a.dt) = ' . $curmonth . ' AND YEAR(a.dt) = ' . $curyear;
}
$data = $db->getRows($sql);


echo json_encode($data);