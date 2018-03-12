<?php
	require 'DBAccess.class.php';
	require 'config.admin.php';
    $sql =  "SELECT count(id) as count FROM users " . 
            " WHERE account='" . $_POST['username'] . "'" .
            " AND password='" . $_POST['password'] . "'";
    echo $sql;
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
    $data = $db->getValue($sql);
    echo $data;
    
    session_start();

    if ($data == 1) {
        $_SESSION['account'] = $_POST['username'];
    } else {
        $_SESSION['account'] = '';
    }

    echo $_SESSION['account'];

    echo "_SESSION['account'] = " . $_SESSION['account'];

    echo 'strlen = ' . strlen($_SESSION['account']); 

	if (strlen($_SESSION['account']) == 0) {
		header('Location: ' . '/smartbuilding/login.php');
	} else {
		header('Location: ' . '/smartbuilding/');
	}

//    echo $_POST['username'];
//    echo $_POST['password'];

 