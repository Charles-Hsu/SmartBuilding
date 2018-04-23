<?php session_start();
    require 'lib/DBAccess.class.php';
    require 'config/config.admin.php';
    require 'lib/utils.php';

    $username = $_SESSION['username'];
    $ip = $_SESSION['ip'];

    $db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

    my_log($db, $ip, $username, "使用者登出");

    $url = "login.php";
    session_destroy();
    header("Location:$url");
?>