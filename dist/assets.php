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
	<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>

<?php
	require 'DBAccess.class.php';
	require 'config.admin.php';
	$sql = 'SELECT * FROM assets';
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
	$data = $db->getRows($sql);
	session_start();
	echo "_SESSION['account'] = " . $_SESSION['account'];
	echo strlen($_SESSION['account']);
//	var_dump($data);

	if (strlen($_SESSION['account']) == 0) {
		header('Location: ' . '/smartbuilding/login.php');
	}
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
												<a class="nav-link active" href="assets.php">資產管理</a>
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
														<th>修改</th>
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
														<td><span><?=$var[asset_no]?></span></td>
														<td><span><?=$var[asset_name]?></span></td>
														<td><span><?=$var[status]?></span></td>
														<td><span><?=$var[price]?></span></td>
														<td><a href="javascript:;" class="btn btn-outline-secondary">修改</a></td>
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
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			$('.asset-table').DataTable({
				"oLanguage": {
					"sLengthMenu": "每頁顯示 _MENU_ 條紀錄",
					"sZeroRecords": "抱歉， 没有找到",
					"sInfo": "從 _START_ 到 _END_ /共 _TOTAL_ 調數據",
					"sInfoEmpty": "沒有數據",
					"sInfoFiltered": "(從 _MAX_ 條數據中搜尋)",
					"oPaginate": {
						"sFirst": "第一頁",
						"sPrevious": "上一頁",
						"sNext": "下一頁",
						"sLast": "最後一頁"
					}
				}
			});
		})
	</script>
	<script src="js/app.js"></script>
</body>

</html>