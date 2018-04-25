<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SmartBuilding</title>
	<link href="<?= $urlName ?>/css/reset.css" rel="stylesheet">
	<link href="<?= $urlName ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= $urlName ?>/css/fontawesome.css" rel="stylesheet">
	<link href="<?= $urlName ?>/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
	<link href="<?= $urlName ?>/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="<?= $urlName ?>/css/jquery.cxcalendar.css" rel="stylesheet">
	<link href="<?= $urlName ?>/css/index.css?<?php echo time() ?>" rel="stylesheet">
	<script src="<?= $urlName ?>/js/lib/jquery-3.1.1.min.js"></script>
	<script src="<?= $urlName ?>/js/popper.min.js"></script>
	<script src="<?= $urlName ?>/js/bootstrap.min.js"></script>
	<script src="<?= $urlName ?>/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= $urlName ?>/js/bootstrap-datepicker.zh-TW.min.js"></script>
	<script src="<?= $urlName ?>/js/jquery.dataTables.min.js"></script>
    <script src="<?= $urlName ?>/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= $urlName ?>/js/jquery.cxcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
	<script src="<?php echo $urlName; ?>/js/app.js?<?php echo time(); ?>"></script>
</head>

<?php
	require 'lib/DBAccess.class.php';
    require 'config/config.admin.php';
    require 'sidebar.php';
?>
