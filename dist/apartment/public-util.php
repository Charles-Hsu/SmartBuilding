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

	$pre_url = "$urlName/apartment";
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/mails.php";?>">郵件紀錄</a>
                </li>
				<li class="nav-item">
					<a class="nav-link active" href="#">公設預約</a>
				</li>
				<?php
					if ($_isAdmin) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/meeting-man.php";?>">會議管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/building.php";?>">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . ".php";?>">基本資料</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/settings.php";?>">參數設定</a>
                </li>
				<?php
					}
				?>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/apartment/publicutil-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增公共設施
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>設施名稱</th>
							<th>費用</th>
							<th>備註</th>
							<th>預約</th>
							<th>編輯</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = 'SELECT *  FROM facilities ORDER BY id ASC';
							$data = $db->getRows($sql);
							$pre_url = "$urlName/apartment/publicutil";
							foreach($data as $facility) {
						?>
						<tr>
							<td><span><?=$facility[name];?></span></td>
							<td><span><?=$facility[charge];?></span></td>
							<td><span><?=$facility[comment];?></span></td>
							<td><a href="<?php echo $pre_url."-appointment.php?id=".$facility['id'];?>" class="btn btn-outline-secondary">預約</a></td>
							<td><a href="<?php echo $pre_url."-edit.php?id=".$facility['id'];?>" class="btn btn-outline-secondary">修改</a></td>
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
	"searching": false,
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋公共設施...",
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
	"processing": true,
	"ordering": false,
})
</script>
<?php include('../Footer.php'); ?>