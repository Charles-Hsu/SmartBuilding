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
								<div class="col-12 p-4">
									<div class="asset-manage-wrapper">
										<ul class="nav nav-pills mb-3">
											<li class="nav-item">
												<a class="nav-link active" href="assets.html">資產管理</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="household.html">住戶管理</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="publicfacilities.html">公共設施預約</a>
											</li>
										</ul>
										<div id="assets-tab">
											<form action="" class="search-assets mb-3">
												<input type="text" placeholder="搜尋資產..." class="form-control w-15">
											</form>
											<a href="./assets-page/create.php" class="btn add-asset-btn mb-3">
												<span>+</span>新增資產
											</a>
											<table class="table asset-table">
												<thead class="thead-light">
													<tr>
														<th>資產編號</th>
														<th>資產名稱</th>
														<th>使用狀態</th>
														<th>價格</th>
													</tr>
												</thead>
												<tbody>
<?php
	foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>

													<tr>
														<td><?=$var[asset_no]?></td>
														<td><?=$var[asset_name]?></td>
														<td><?=$var[status]?></td>
														<td><?=$var[price]?></td>
													</tr>
<?php
	}
?>
<!--
													<tr>
														<td>AST0001A</td>
														<td>測試用資產A</td>
														<td>使用中</td>
														<td>3000</td>
													</tr>
-->													
												</tbody>
											</table>
											<ul class="pagination justify-content-end">
												<li class="page-item disabled">
													<a class="page-link" href="#" tabindex="-1"><</a>
												</li>
												<li class="page-item disabled">
													<a class="page-link" href="#">1</a>
												</li>
												<li class="page-item">
													<a class="page-link" href="#">2</a>
												</li>
												<li class="page-item">
													<a class="page-link" href="#">3</a>
												</li>
												<li class="page-item">
													<a class="page-link" href="#">></a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="js/app.js"></script>
</body>

</html>