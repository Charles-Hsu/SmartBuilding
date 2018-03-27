
<?php
require '../lib/DBAccess.class.php';
require '../config/config.admin.php';

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $msg=array();
    $sql = "SELECT a.id,building,addr_no,floor,b.name AS status,holder,resident FROM household a, household_status b WHERE a.status = b.id and a.id=$id";
    //$sql = "SELECT a.id,building,addr_no,floor,b.name AS status,holder,resident FROM household a, household_status b WHERE a.status = b.id";
    
    $db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
    $data = $db->getRows($sql);

    $msg[0]=1;
    $msg[1]=$data;

    //var_dump($data);

    echo json_encode($msg);
}else{
    $id='';
    return;
}