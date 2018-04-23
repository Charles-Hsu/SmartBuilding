<?php session_start(); ?>
<?php
	include('../config.php');
	include('../Header.php');

	if (!$_SESSION['online']) {
		$url = "$urlName/login.php";
		header("Location: " . $url);
	}

	$_isAdmin = $_SESSION['admin'];
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/mails.php">郵件紀錄</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/public-util.php">公設預約</a>
				</li>
				<?php
					if ($_isAdmin) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/meeting-man.php">會議管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/apartment/building.php">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment.php">基本資料</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/settings.php">參數設定</a>
                </li>
				<?php
					}
				?>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/apartment/building-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增社區建築
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>名稱</th>
							<th>代碼</th>
							<th>地址</th>
							<th>建築執照編號</th>
							<th>發照日期</th>
							<!-- <th>使用年限</th> -->
							<!-- <th>編輯</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT alias_name,id,name,address,license_no,approved_date FROM building";
							// echo $sql;
							$data = $db->getRows($sql);
							foreach($data as $building) {
						?>
						<tr>
							<td><span><?=$building[name];?></span></td>
							<td><span><?php echo $building['alias_name'];?></span></td>
							<td><span><?=$building[address];?></span></td>
							<td><span><?=$building[license_no];?></span></td>
							<td><span><?=$building[approved_date];?></span></td>
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

<script>
$('.asset-table').DataTable({
	"language": {
		/*
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋資產...",
		*/
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
	"searching": false,
	"deferRender": true,
	"processing": true,
	"ordering": false,
})
</script>
<?php include('../Footer.php'); ?>