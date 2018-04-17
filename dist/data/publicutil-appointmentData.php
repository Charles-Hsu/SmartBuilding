<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';
$db   = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$method_type=$_POST['method_type'];
$public_util_type = $_POST['public_util_type'];
$reserveDate=$_POST['reserveDate'];
$checkArrTime   = $_POST['checkArrTime'];
$household_num = $_POST['household_num'];
$household_floor = $_POST['household_floor'];

class Msg{
    public $success='';
    public $data='';
}
if($method_type === 'update'){
    if(isset($_POST['household_num']) && isset($_POST['household_floor'])){
        $household_num="'".$household_num."'";
        $household_sql = "SELECT * FROM `household` where addr_no = $household_num and floor = $household_floor ";
        $household_data=$db->getRow($household_sql);

        if( $household_data ){
            $household_id=$household_data['id'];

            $msg=new Msg();
            $msg->success=true;
            foreach($checkArrTime as $prop){
                $facility_reserve_sql="INSERT INTO `facility_reserve` (`id`,`facility_id`,`dt`,`house_id`) VALUES (NULL,'$public_util_type','$reserveDate $prop','$household_id')";
                // echo $facility_reserve_sql;
                $db->insert($facility_reserve_sql);
            }

            $sql = "SELECT a.*,DATE_FORMAT(a.dt, '%H:%i') as time,b.addr_no,b.floor FROM facility_reserve as a,household as b WHERE a.house_id = b.id AND facility_id=$public_util_type AND DATE_FORMAT(a.dt,'%Y-%m-%d') = '$reserveDate'";
            $data=$db->getRows($sql);
            $msg->data=$data;
        }else{
            $msg=new Msg();
            $msg->success=false;
            $msg->data='請正確輸入!!';
        }

    }else {
        $msg=new Msg();
        $msg->success=false;
        $msg->data='false';
    }
}

if($method_type === 'get'){
    $sql = "SELECT a.*,DATE_FORMAT(a.dt, '%H:%i') as time,b.addr_no,b.floor FROM facility_reserve as a,household as b WHERE a.house_id = b.id AND facility_id=$public_util_type AND DATE_FORMAT(a.dt,'%Y-%m-%d') = '$reserveDate'";

    $data=$db->getRows($sql);

    $msg=new Msg();
    $msg->success=true;
    $msg->data=$data;
}
echo json_encode($msg);