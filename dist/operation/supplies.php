<?php session_start(); ?>
<?php
	include('../config.php');
	include('../Header.php');
	if (!$_SESSION['online']) {
		$url = "$urlName/login.php";
		header("Location: " . $url);
	}
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
	$_isAdmin = $_SESSION['admin'];
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
			 	<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/energy.php">節約能源</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation.php">例行作業</a>
				</li>
				<?php
                    if ($_isAdmin) {
                ?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <?php
					}
                ?>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/operation/supplies-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增耗材
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>耗材名稱</th>
							<th>耗材編號</th>
							<th>價格</th>
							<th>品牌</th>
							<th>修改</th>
						</tr>
					</thead>
					<tbody>
<?php
	//foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>

						<tr>
							<td><span>日光燈管</span></td>
							<td><span>00002</span></td>
							<td><span>5000</span></td>
							<td><span>飛利浦</span></td>
							<td><a href="<?= $urlName ?>/operation/supplies-edit.php" class="btn btn-outline-secondary">修改</a></td>
						</tr>
<?php
	//}
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
$('.asset-table').DataTable({
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋資產...",
		"info": "從 _START_ 到 _END_ /共 _TOTAL_ 筆資料",
		"infoEmpty": "",
		"emptyTable": "目前沒有資料",
		"lengthMenu": "每頁顯示 _MENU_ 筆資料",
		"zeroRecords": "搜尋無此資料",
		"infoFiltered": " 搜尋結果 _MAX_ 筆資料",
		"paginate": {
			"previous": "上一頁",
			"next": "下一頁",
			"first": "第一頁",
			"last": "最後一頁"
		}
	},
	"deferRender": true,
	"processing": true
})
</script>
<?php include('../Footer.php'); ?>