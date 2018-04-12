<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 
$table = 'facilities';
$sql = 'SELECT * FROM ' . $table . ' ORDER BY id ASC';
//echo $sql;
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);

//if (strlen($_SESSION['account']) == 0) {
//	header('Location: ' . '/smartbuilding/login.php');
//}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment.php">基本資料</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/building.php">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/apartment/public-util.php">公共設施</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/meeting-man.php">會議管理</a>
				</li>				
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/meeting-resolution.php">決議事項</a>
				</li>				
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/settings.php">規約設定</a>
                </li>			
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/apartment/publicutil-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增公共設施
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
<!--							
							<th>#</th>
-->						
							<th>設施名稱</th>
							<th>費用</th>
							<th>備註</th>
							<th>預約</th>
							<th>編輯</th>
						</tr>
					</thead>
					<tbody>
<?php
	// foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>
<?php
	 foreach($data as $facility) {
?>

						<tr>
<!--
							<td><span><?=$facility[id];?></span></td>
-->
							<td><span><?=$facility[name];?></span></td>
							<td><span><?=$facility[charge];?></span></td>
							<td><span><?=$facility[comment];?></span></td>
							<td><a href="<?= $urlName ?>/apartment/publicutil-appointment.php?id=<?=$facility[id];?>" class="btn btn-outline-secondary">預約</a></td>
							<td><a href="<?= $urlName ?>/apartment/publicutil-edit.php?id=<?=$facility[id];?>" class="btn btn-outline-secondary">修改</a></td>
						</tr>
<?php
	 }
?>
<!--
						<tr>
							<td><span>KTV - 娛樂室</span></td>
							<td><span>400</span></td>
							<td><span>最多10人同時使用</span></td>
							<td><a href="<?= $urlName ?>/apartment/publicutil-appointment.php" class="btn btn-outline-secondary">預約</a></td>
							<td><a href="<?= $urlName ?>/apartment/publicutil-edit.php" class="btn btn-outline-secondary">修改</a></td>
						</tr>
-->						
<?php
	// }
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