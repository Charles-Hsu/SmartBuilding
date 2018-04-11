<?php 
include('./config.php');
include('./Header.php'); 
?>
<?php 

$sql = 'SELECT a.name AS staffname,a.mobile,a.no,b.title,c.name FROM staff a, staff_role b, contract c WHERE a.role = b.id AND a.contract_id = c.id';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);

//var_dump($data);

session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org.php">人員</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/opinions.php">住戶意見</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/works.php">工作日誌</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/mails.php">郵件紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會/a>
                </li>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/org/org-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增社區職員
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>姓名</th>
							<th>手機號碼</th>
							<th>員工編號</th>
							<th>職稱</th>
							<th>所屬物業公司</th>
							<th>修改</th>
						</tr>
					</thead>
					<tbody>
<?php
foreach($data as $staff) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>

						<tr>
							<td><span><?=$staff['staffname'];?></span></td>
							<td><span><?=$staff['mobile'];?></span></td>
							<td><span><?=$staff['no'];?></span></td>
							<td><span><?=$staff['title'];?></span></td>
							<td><span><?=$staff['name'];?></span></td>
							<td><a href="<?= $urlName ?>/org/org-edit.php?no=<?=$staff['no'];?>" class="btn btn-outline-secondary">修改</a></td>
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
	"processing": true,
	"order": [[2, 'asc']],
	"searching": false,
})
</script>
<?php include('./Footer.php'); ?>