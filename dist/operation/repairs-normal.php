<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 

$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);

if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation.php">例行作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/energy.php">節約能源</a>
                </li>
			</ul>
			<div id="assets-tab" class="row mr-0 ml-0">
				<div class="repairs-content col-10">
					<a href="<?= $urlName ?>/operation/repairs-normal-create.php" class="btn add-asset-btn mb-3">
						<span>+</span>新增維修作業
					</a>
					<table class="table asset-table">
						<thead class="thead-light">
							<tr>
								<th>維修內容</th>
								<th>類別</th>
								<th>故障發生時間</th>
								<th>修改</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><span>異常回報測試修改</span></td>
								<td><span>警衛安全</span></td>
								<td><span>2018-02-10</span></td>
								<td><a href="<?= $urlName ?>/operation/repairs-normal-edit.php" class="btn btn-outline-secondary">修改</a></td>
							</tr>
						</tbody>
					</table>
				</div>
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