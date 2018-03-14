<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SmartBuilding</title>
	<link href="/smartbuilding/css/reset.css" rel="stylesheet">
	<link href="/smartbuilding/css/bootstrap.min.css" rel="stylesheet">
	<link href="/smartbuilding/css/fontawesome.css" rel="stylesheet">
	<link href="/smartbuilding/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
	<link href="/smartbuilding/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="/smartbuilding/css/index.css" rel="stylesheet">
	<script src="/smartbuilding/js/lib/jquery-3.1.1.min.js"></script>
	<script src="/smartbuilding/js/popper.min.js"></script>
	<script src="/smartbuilding/js/bootstrap.min.js"></script>
	<script src="/smartbuilding/js/bootstrap-datepicker.min.js"></script>
    <script src="/smartbuilding/js/bootstrap-datepicker.zh-TW.min.js"></script>
	<script src="/smartbuilding/js/jquery.dataTables.min.js"></script>
	<script src="/smartbuilding/js/dataTables.bootstrap4.min.js"></script>
</head>

<?php
	require 'DBAccess.class.php';
	require 'config.admin.php';
?>
<body class="d-flex">
    <div class="sidemenu">
        <div class="sidemenu-wrapper">
            <div class="sidemenu-title my-4">
                <i class="fab fa-optin-monster"></i>
                <span><?=$conf['sysname']?></span>
            </div>
            <ul class="sidemenu-nav">
                <li>
                    <a href="#" class="" class="d-flex sidemenu-link" title="效能管理">
                        <i class="far fa-chart-bar"></i>
                        <span>效能管理</span>
                    </a>
                </li>
                <li>
                    <a href="/smartbuilding/assets.php" class="" class="d-flex sidemenu-link" title="資產管理">
                        <i class="fas fa-book"></i>
                        <span>資產管理</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="" class="d-flex sidemenu-link" title="組織管理">
                        <i class="fas fa-users"></i>
                        <span>組織管理</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="" class="d-flex sidemenu-link" title="維運管理">
                        <i class="far fa-address-book"></i>
                        <span>維運管理</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="" class="d-flex sidemenu-link" title="社區資料">
                        <i class="fas fa-home"></i>
                        <span>社區資料</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="" class="d-flex sidemenu-link" title="社區檔案庫">
                        <i class="far fa-folder"></i>
                        <span>社區檔案庫</span>
                    </a>
                </li>
                <li>
                    <a href="/smartbuilding/profile.php" class="" class="d-flex sidemenu-link" title="個人資料">
                        <i class="far fa-smile"></i>
                        <span>個人資料</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="" class="d-flex sidemenu-link" title="登出">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>登出</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="content-wrapper">
            <div class="content-header">
                <i class="slide-toggle-btn fas fa-outdent"></i>
            </div>
            <div class="content-main-wrapper p-3">
                <div class="content-main container-fluid">