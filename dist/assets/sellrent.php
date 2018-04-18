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
					<a class="nav-link" href="<?= $urlName ?>/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>//assets/household.php">產權管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/assets/sellrent.php">租售管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/assets/brokerman.php">帶看管理</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/assets/hoa_fee.php">管理費</a>
                </li>
			</ul>
			<div id="assets-tab">
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>大樓</th>
							<th>戶號</th>
							<th>樓層</th>
							<th>區權人</th>
							<th>欠繳</th>
							<th>紀錄</th>
							<th>帶看</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = 'SELECT a.id AS id,building,addr_no,floor,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id';
							$data = $db->getRows($sql);
						?>
						<?php
							foreach($data as $var) {
								$sql = "SELECT SUM(fee) AS s FROM hoa_fee_record WHERE hid = $var[id] AND p IS NULL";
								$s = $db->getRow($sql);
								$s = $s['s'];
						?>
						<tr>
							<td><span><?=$var[building]?></span></td>
							<td><span><?=$var[addr_no]?></span></td>
							<td><span><?=$var[floor]?></span></td>
							<td><span><?=$var[holder]?></span></td>
							<td><span><?php echo number_format($s);?></span></td>
							<td>
								<?php
									if($s != 0) {
										echo '<a href="#" class="btn btn-outline-secondary">';
										echo '顯示';
										echo '</a>';
									}
								?>
							</td>
							<td><a href="/smartbuilding/assets/sellrent-edit.php?id=<?=$var[id]?>" class="btn btn-outline-secondary">設定</a></td>
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
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋住戶...",
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
<?php
include(Document_root.'/Footer.php');
?>