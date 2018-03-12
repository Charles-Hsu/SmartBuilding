<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SmartBuilding</title>
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link href="./css/fontawesome.css" rel="stylesheet">
	<link rel="stylesheet" href="css/index.css">
	<script src="./js/lib/jquery-3.1.1.min.js"></script>
	<script src="./js/popper.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>

<?php
	require 'DBAccess.class.php';
	require 'config.admin.php';
	$sql = 'SELECT * FROM assets';
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
	$data = $db->getRows($sql);
//	var_dump($data);
	session_start();
/*
	if (strlen($_SESSION['account']) == 0) {
		header('Location: ' . '/smartbuilding/login.php');
	} else {
		header('Location: ' . '/smartbuilding/');
	}
*/
?>

<body>
	<div id="app" class="main-wrapper">
		<div class="d-flex">
			<div class="sidemenu" :class="{slideToggleActive}">
				<div class="sidemenu-wrapper">
					<div class="sidemenu-title my-4">
						<i class="fab fa-optin-monster"></i>
						<span><?=$conf['sysname']?></span>
					</div>
					<ul class="sidemenu-nav">
						<li v-for="(sidemenu,index) in sidemenuList" v-cloak>
							<a :href="sidemenu.link" :class="{active:sidemenu.active}" class="d-flex sidemenu-link" :title="sidemenu.name">
								<i :class="sidemenu.icon"></i>
								<span>{{sidemenu.name}}</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="content">
				<div class="content-wrapper">
					<div class="content-header">
						<i class="slide-toggle-btn fas fa-outdent" @click="slideToggle"></i>
					</div>
					<div class="content-main-wrapper p-3">
						<div class="content-main container-fluid">
							<!-- 內容切換區 -->
							<div class="row">

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<script src="js/app.js"></script>
</body>

</html>