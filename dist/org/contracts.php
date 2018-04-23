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
					<a class="nav-link" href="<?= $urlName ?>/org.php">人員</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>

                <!-- <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li> -->
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/org/contract-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增廠商
				</a>
				<!-- <a href="<?= $urlName ?>/org/contract-man.php" class="btn add-asset-btn mb-3">
					<span>+</span>協約管理
				</a> -->
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>合約日期</th>
							<th>廠商名稱</th>
							<th>合約類別</th>
							<th>評分</th>
							<th>聯絡人</th>
							<th>聯絡方式</th>
							<th>修改</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = 'SELECT a.id AS contract_id, score,dt,name,contact_person,contact_phone,b.item AS item FROM contract a, contract_item b WHERE a.id != 0 AND a.contract_item = b.id';
							$data = $db->getRows($sql);
							foreach($data as $var) {
						?>
						<tr>
							<td><span><?php echo $var['dt'];?></span></td>
							<td><span><?php echo $var['name'];?></span></td>
							<td><span><?php echo $var['item'];?></span></td>
							<td>
								<span>
									<?php
										if (strlen($var['score']) != 0) {
											echo $var['score'];
										}
										else {
											echo "<a href='./contract-eval.php?contract_id=$var[contract_id]'>自評</a>";
										}
									?>
								</span>
							</td>
							<td><span><?php echo $var['contact_person'];?></span></td>
							<td><span><?php echo $var['contact_phone'];?></span></td>
							<td><a href="<?= $urlName ?>/org/contract-edit.php?contract_id=<?php echo $var['contract_id'];?>" class="btn btn-outline-secondary">修改</a></td>
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