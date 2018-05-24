<?php error_reporting(E_ERROR | E_WARNING | E_PARSE); ?>
<?php
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
?>

<?php

$_GET['q'];


$data[0] = (object)['ip' => '192.168.11.111'];
$data[1] = (object)['username' => 'charles'];
$data[2] = (object)['role' => '0'];
// $data[3] = (object)['q' => $_GET['q']];


echo json_encode($data);
