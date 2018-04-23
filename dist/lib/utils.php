<?php

// require './DBAccess.class.php';
// require '../config/config.admin.php';

function my_log($db, $ip, $username, $message) {
    // $db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
    // $sql = "SELECT * FROM assets";
    // echo $sql;
    // $data = $db->getRows($sql);
    // var_dump($data);
    echo date('Y-m-d G:i:s') . " $message";
    $sql = "INSERT INTO system_log (`dt`,`ip`,`username`,`message`) VALUES ('" . date('Y-m-d G:i:s') . "', '$ip', '$username', '$message')";
    echo $sql;
    $db->insert($sql);
}


