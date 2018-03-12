<?php

//phpinfo();

/*
require 'lib/core/DBAccess.class.php';
require 'lib/core/Object.class.php';
require 'wjaction/admin/AdminBase.class.php';
*/
require 'DBAccess.class.php';
//require 'Object.class.php';


require 'config.admin.php';
/*
echo $conf['db']['dsn'] . '<br>';
echo $conf['db']['user'] . '<br>';
*/
//print_r($_SERVER);exit;
$para=array();

//$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

//$db = new PDO($conf['db']['dsn'], $conf['db']['user']);
$sql = 'SELECT name FROM test';

/*
foreach( $db->query($sql) as $row)  {
    print_r($row);
}
*/
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
$data = $db->getRows($sql);

/*
$sql = "SELECT name FROM test";
echo '$sql = ' . $sql;
echo '$dbadfafafaf='.$dbadfafafaf.'<br/>';
*/
//$data = $db.test($sql);

var_dump($data);

//echo $db;

//echo 'Hello PHP & MySQL<br>';

?>