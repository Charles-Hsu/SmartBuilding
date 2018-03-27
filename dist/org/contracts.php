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
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">組織管理團</a>
                </li>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/org/contracts-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增廠商
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>廠商名稱</th>
							<th>合約類別</th>
							<th>聯絡人</th>
							<th>聯絡方式</th>
							<th>修改</th>
						</tr>
					</thead>
					<tbody>
<?php

$sql = 'SELECT name,contact_person,contact_phone,b.item AS item FROM contract a, contract_item b WHERE a.id != 0 AND a.contract_item = b.id';
//echo $sql;
$data = $db->getRows($sql);

foreach($data as $var) {
?>
						<tr>
							<td><span><?=$var['name'];?></span></td>
							<td><span><?=$var['item'];?></span></td>
							<td><span><?=$var['contact_person'];?></span></td>
							<td><span><?=$var['contact_phone'];?></span></td>
							<td><a href="<?= $urlName ?>/org/contracts-edit.php" class="btn btn-outline-secondary">修改</a></td>
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