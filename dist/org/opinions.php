<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 

//$sql = 'SELECT a.*, b.addr_no,b.floor FROM opinions a, household b WHERE a.id = b.id AND a.dt_completed = "0000-00-00"';

$sql = 'SELECT a.*, b.addr_no,b.floor FROM opinions a, household b WHERE b.id = a.household_id';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);


session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);
/*
if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}
*/
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
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/opinions.php">住戶意見</a>
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
				<a href="<?= $urlName ?>/org/op-add1.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增住戶意見
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>反應日期</th>
							<th>戶號</th>
							<th>樓層</th>
							<th>主旨</th>
							<th>內容</th>
<!--							
							<th>結案日</th>
-->							
							<th>修改</th>
						</tr>
					</thead>
					<tbody>

<?php
foreach($data as $var) {
	//var_dump($var);

?>					
						<tr>
						<td><span><?=$var['dt'];?></span></td>
						<td><span><?=$var['addr_no'];?></span></td>
						<td><span><?=$var['floor'];?></span></td>
						<td><span><?=$var['title'];?></span></td>
						<td><span><?=$var['detail'];?></span></td>

<?php
/*
$completed = 0;
if ($var['dt_completed'] == '0000-00-00') {
	echo '';
} else {
	$completed = 1;
	echo $var['dt_completed'];
}
*/
?>

						</td>
						<td><a href="<?=$urlName;?>/org/op-edit.php?id=<?=$var['id'];?>" class="btn btn-outline-secondary">結案</a></td>
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
    "order": [[0, 'desc']],
    //"order": [[0, 'asc']],
})
</script>
<?php include('../Footer.php'); ?>