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
					<a class="nav-link" href="<?= $urlName ?>/opinionlist.php">住戶意見</a>
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
					<a class="nav-link active" href="<?= $urlName ?>/regulation.php">管理辦法</a>
				</li>
				<?php
					}
				?>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/evaluation.php">品質管理</a>
                </li>
			</ul>
		</div>

		<div class="files-wrapper">
			<div id="assets-tab">
				<a href="./regulation-new.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增管理辦法
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>公告日期</th>
							<th>管理辦法</th>
							<th>檔案名稱</th>
							<th>下載</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT a.dt,a.desc,a.path,b.id FROM files a, file_type b WHERE a.type = b.id AND a.type = 7"; // 7 管理辦法
							// echo $sql;
							$data = $db->getRows($sql);
							foreach($data as $var) {
						?>
						<tr>
							<td><span><?php echo $var['dt']; ?></span></td>
							<td><span><?php echo $var['desc']; ?></span></td>
							<td><span><?php echo $var['path']; ?></span></td>
							<!-- <td><a href="<?php echo $var['id']/$var['path']; ?>" class="btn btn-primary" download>開啟檔案</a></td> -->
							<td><a href="<?php echo "files/". $var['id'] . "/" . $var['path'];   ?>">開啟檔案</a></td>
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