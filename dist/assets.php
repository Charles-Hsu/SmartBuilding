<?php include('./Header.php'); ?>
<?php 

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
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include('./Footer.php'); ?>