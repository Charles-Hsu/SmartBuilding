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
					<a class="nav-link" href="<?= $urlName ?>/opinionlist.php">反映意見</a>
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
					<a class="nav-link active" href="<?= $urlName ?>/evaluation.php">品質管理</a>
        </li>
				<?php
					}
				?>
			</ul>
		</div>

		<div class="files-wrapper">
			<div id="assets-tab">

				<div class="assets-create-title mb-3">
					<a href="./evaluation.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>獎金提撥</span>
				</div>


				<table class="table non-asset-table">
					<thead class="thead-light">
						<tr>
							<th>年度</th>
							<th>考核對象</th>
							<th>考核次數</th>
							<th>平均分數</th>
							<th>年終獎金</th>
						</tr>
					</thead>


					<!-- SELECT COUNT(*) AS n, AVG(score) AS avg_score FROM evaluation WHERE YEAR(dt) = YEAR(NOW()) -->

					<tbody>
						<?php
							$sql = "SELECT bonus FROM `apartment_settings`"; // 0 團隊績效
							$bonus = $db->getValue($sql);
							// echo "bonus = $bonus";

							$sql = "SELECT YEAR(dt) AS y, COUNT(*) AS n, AVG(score) AS avg, b.name FROM evaluation a, staff b WHERE YEAR(dt) = YEAR(NOW()) AND target_id = 0 AND b.id = 0"; // 0 團隊績效
							// echo $sql;
							$data = $db->getRows($sql);
							foreach($data as $var) {
						?>
						<tr>
							<td><span><?php echo $var['y']; ?></span></td>
							<td><span><?php echo $var['name']; ?></span></td>
							<td><span><?php echo $var['n']; ?></span></td>
							<td><span><?php echo number_format($var['avg'],1); ?></span></td>
							<td><span><?php if($var['avg'] < 75) {$bonus = 0;} echo number_format($bonus,0); ?></span></td>

						</tr>
						<?php
							}
						?>
					</tbody>
				</table>


				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>年度</th>
							<th>考核對象</th>
							<th>考核次數</th>
							<th>平均分數</th>
							<th>考績</th>
							<th>績效獎金</th>
						</tr>
					</thead>


					<!-- SELECT COUNT(*) AS n, AVG(score) AS avg_score FROM evaluation WHERE YEAR(dt) = YEAR(NOW()) -->

					<tbody>
						<?php
							$sql = "SELECT performance_bonus FROM `apartment_settings`";
							$performance_bonus = $db->getValue($sql);
							// echo "bonus = $bonus";

							$sql = "SELECT YEAR(dt) AS y, AVG(score) AS avg, b.name FROM evaluation a, staff b WHERE YEAR(dt) = YEAR(NOW()) AND b.id != 0 GROUP BY b.id";

							$sql = "SELECT year(dt) AS y,avg(a.score) AS avg ,count(*) AS n,b.id,b.name FROM evaluation a, staff b WHERE YEAR(dt) = YEAR(NOW()) AND a.target_id = b.id and b.id != 0 group by b.id, b.name
							";


							// echo $sql;
							$data = $db->getRows($sql);
							foreach($data as $var) {
						?>
						<tr>
							<td><span><?php echo $var['y']; ?></span></td>
							<td><span><?php echo $var['name']; ?></span></td>
							<td><span><?php echo $var['n']; ?></span></td>
							<td><span><?php echo number_format($var['avg'],1); ?></span></td>
							<td>
								<span>
									<?php
										// $sql = "SELECT performance_bonus FROM `apartment_settings`";
										// $bonus = $db->getValue($sql);
										// if((int)$var['avg'] < 80) {
										// 	$bonus = 0;
										// }
										$v = (int)$var['avg'];
										// echo number_format($v,0);
										// echo number_format($bonus,0);
										$percentage = 0;
										if ($v >= 95) {
											// echo "big";
											echo 'A';
											$percentage = 1;
										} else if ($v >= 90) {
											echo 'B';
											$percentage = 0.8;
										} else if ($v >= 85) {
											echo 'C';
											$percentage = 0.6;
										} else if ($v >= 80) {
											echo 'D';
											$percentage = 0.4;
										} else {
											echo 'E';
											$percentage = 0.0;
										}
										// echo number_format($bonus,0);
										// echo number_format($bonus,1);
									?>
								</span>
							</td>
							<td>
								<span>
									<?php
										// $sql = "SELECT performance_bonus FROM `apartment_settings`";
										// $bonus = $db->getValue($sql);
										// if((int)$var['avg'] < 80) {
										// 	$bonus = 0;
										// }
										// $v = (int)$var['avg'];
										// echo number_format($v,0);
										// echo number_format($bonus,0);
										$bonus = $performance_bonus * $percentage;
										// if ($v > 80) {
										// 	// echo "big";
										// 	$bonus = $performance_bonus;
										// } else {
										// 	// echo "small";
										// 	$bonus = 0;
										// }
										echo number_format($bonus,0);
										// echo number_format($bonus,1);
									?>
								</span>
							</td>
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
        "columnDefs": [
            { "searchable": false, "targets": 1 },
            { "searchable": false, "targets": 2 },
        ],
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋文件名稱...",
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