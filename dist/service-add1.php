<?php session_start(); ?>
<?php
	include('./config.php');
	include('./Header.php');
	if (!$_SESSION['online']) {
		$url = "./login.php";
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
					<a class="nav-link" href="<?= $urlName ?>/announcement.php">公告</a>
				</li>
        <li class="nav-item">
					<a class="nav-link" href="<?=$urlName?>/activities.php">活動資訊</a>
        </li>
        <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/opinionlist.php">反映意見</a>
        </li>
        <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/service.php">支援服務</a>
        </li>
        <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/overduelist.php">欠繳費用</a>
        </li>
				<?php
					if ($_isAdmin) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/kpi.php">績效指標</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/space-management.php">空間變更</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/regulation.php">管理辦法</a>
				</li>
        <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/evaluation.php">品質管理</a>
        </li>
				<?php
					}
				?>
			</ul>

			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/service.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增住戶支援服務 (選擇住戶)</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-12">
						<table class="table asset-table">
							<thead class="thead-light">
								<tr>
									<th>門牌代碼</th>
									<th>戶號</th>
									<th>樓層</th>
									<th>區權人</th>
									<th>現住戶</th>
									<th>支援服務</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
									$sql = 'SELECT a.id AS id,building,addr_no,floor,"1100" as unpaid_total,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id';

									$sql = 'SELECT a.* FROM household a';


									$data = $db->getRows($sql);
									foreach($data as $var) {
								?>
								<tr>
									<td><span><?php echo strtoupper($var[short_id]);?></span></td>
									<td><span><?php echo $var[addr_no];?></span></td>
									<td><span><?php echo $var[floor];?></span></td>
									<td><span><?php echo $var[holder];?></span></td>
									<td><span><?php echo $var[resident];?></span></td>
									</td>
									<td><a href="service-add2.php?id=<?php echo $var[id];?>" class="btn btn-outline-secondary">服務內容</a></td>
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
	"processing": true,
	"order": [[0, 'desc']],
})
</script>