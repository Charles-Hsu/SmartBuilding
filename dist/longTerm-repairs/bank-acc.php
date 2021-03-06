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

<?php

$sql = 'SELECT a.*,b.type FROM bank_acc a, bank_acc_type b WHERE a.account_type = b.id';
$data = $db->getRows($sql);
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/longTerm-repairs/budget.php">年度預算</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/longTerm-repairs/budget-planning.php">財務籌措</a>
                </li>
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/longTerm-repairs/bank-acc.php">銀行專戶</a>
                </li>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/longTerm-repairs/bankacc-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增銀行專戶
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>專戶用途</th>
							<th>專戶類型</th>
							<th>銀行名稱</th>
<!--
							<th>銀行編號</th>
-->
							<th>帳戶名稱</th>
							<th>帳戶編號</th>
							<th>帳戶餘額</th>
							<th>修改</th>
						</tr>
					</thead>
					<tbody>
<?php
	 foreach($data as $account) {
?>

						<tr>
							<td><span><?=$account[account_purpose];?></span></td>
							<td><span><?=$account[type];?></span></td>
							<td><span><?=$account[bank_name];?></span></td>
							<td><span><?=$account[account_name];?></span></td>
							<td><span><?=$account[account_number];?></span></td>
							<td><span><?=number_format($account[account_balance]);?></span></td>
							<td><a href="<?= $urlName ?>/longTerm-repairs/bankacc-edit.php?id=<?=$account[id];?>" class="btn btn-outline-secondary">修改</a></td>
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
	"ordering": false,
	"searching": false,
	"paging": false,
})
</script>
<?php include('../Footer.php'); ?>