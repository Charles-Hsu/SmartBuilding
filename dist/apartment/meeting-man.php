<?php session_start(); ?>
<?php
	include('../config.php');
	include('../Header.php');
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
					<a class="nav-link active" href="<?= $urlName ?>/apartment/meeting-man.php">會議管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/building.php">建築物</a>
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
				<a href="<?php echo $urlName;?>/apartment/meeting-man-new.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增會議
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>日期</th>
							<th>屆別</th>
							<th>次</th>
							<th>會議種類</th>
							<th>出席狀況</th>
							<th>出席率</th>
						</tr>
					</thead>
					<tbody>
<?php
$sql = "SELECT a.meeting_type, a.id AS meeting_id, a.att_rate, a.date, b.name AS type, c.name AS session ,d.name AS round  FROM meetings a, meeting_type b, session c, round d WHERE a.meeting_type = b.id AND a.round = d.id AND a.session = c.id";
$data = $db->getRows($sql);
foreach($data AS $var) {
?>
						<tr>
							<td><?php echo $var[date];?></td>
							<td><?php echo $var[session];?></td>
							<td><?php echo $var[round];?></td>
							<td><?php echo $var[type];?></td>
							<td><a href="meeting-attend.php?id=<?php echo $var[meeting_id];?>&type=<?php echo $var[meeting_type];?>">更新</a></td>
							<td><?php echo number_format($var[att_rate],1);?> %</td>
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