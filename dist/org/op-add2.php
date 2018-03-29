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

<?php 
$id = $_GET['id'];

$sql = 'SELECT a.id AS id,building,addr_no,floor,unpaid_total,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id AND a.id = ' . $id;;
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
$var = $data[0];

?>

<?php

if (count($_POST) > 0) {
	var_dump($_POST);
	$dt = strftime('%F'); 
	$title = $_POST['household-title'];
	$detail = $_POST['household-content'];
	
	$sql = "INSERT INTO `opinions` (`id`, `dt`, `household_id`, `title`, `detail`, `dt_completed`) VALUES (NULL, '";
	$sql .= $dt . "', " . $id . ", '" . $title . "', '" . $detail . "', '0000-00-00')";

	echo $sql;
				
	if ($db->insert($sql)) {
				//if ($db->insertRow($table, $data)) {
		$message="新增成功";
	}

?>
<script>
	window.location = "./opinions.php";
</script>
<?php
}
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
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/org/op-add1.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增住戶意見 (意見)</span>
				</div>
				
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">                   
							<div class="form-group row">
								<label for="household-title" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>主旨:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-title" id="household-title">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-content" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>意見:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-content" id="household-content">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-reply" class="text-right col-md-4 col-form-label">
									反應住戶:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-reply" id="household-reply" value="<?=$var[holder];?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-primary">確定</button>
									<button class="btn btn-outline-secondary">取消</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">

			<div id="assets-tab">
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>大樓</th>
							<th>戶號</th>
                            <th>樓層</th>
							<th>區權人</th>
                            <th>現住戶</th>
						</tr>
					</thead>
					<tbody>

<?php
	foreach($data as $var) {
?>
						<tr>
							<td><span><?=$var[building];?></span></td>
							<td><span><?=$var[addr_no];?></span></td>
							<td><span><?=$var[floor];?></span></td>
							<td><span><?=$var[holder];?></span></td>
							<td><span><?=$var[resident];?></span></td>
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
/*
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
*/
</script>

<?php 
include(Document_root.'/Footer.php');
?>