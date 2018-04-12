<?php

require '../lib/DBAccess.class.php';
require '../config/config.admin.php';

$title = $_POST['title'];
$addr_no = $_POST['addr_no'];
$floor = $_POST['floor'];
$holder = $_POST['holder'];

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

class Msg {
    public $success   = '';
    public $data  = '';
}

$sql = "SELECT session AS session_id FROM committee ORDER BY session DESC LIMIT 1";
$data = $db->getRow($sql);
$current_session_id = $data['session_id'];

$sql = "SELECT d.holder, d.addr_no, d.floor, c.name AS session_name, c.id AS session_id, b.title, b.id AS role_id FROM committee a, committee_role b, session c, household d WHERE a.role_id = b.id AND a.session = c.id AND d.id = a.holder_id AND a.session = $current_session_id";
$data = $db->getRows($sql);
echo 123;

$msg=new Msg();

$msg->success=true;
$msg->data=$data;

echo json_encode($msg);