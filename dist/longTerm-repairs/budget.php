<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 

//$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

//$data = $db->getRows($sql);
//session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);

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
					<a class="nav-link active" href="<?= $urlName ?>/longTerm-repairs/budget.php">年度預算</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/longTerm-repairs/budget-planning.php">財務籌措</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/longTerm-repairs/bank-acc.php">銀行專戶</a>
                </li>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/longTerm-repairs/budget-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>預算編列
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>預算名稱</th>
							<th>編列日期</th>
							<th>預算金額</th>
                            <th>銀行</th>
							<th>帳號</th>
<!--							
                            <th>餘額</th>
							<th>帳戶目的</th>
-->							
<!--                            
                            <th>修改</th>
-->                            
						</tr>
					</thead>
					<tbody>
<?php
$sql = 'SELECT a.name,a.planning_dt AS dt,a.amount,b.bank_name,b.account_number,b.account_purpose,b.account_balance FROM budget a, bank_acc b WHERE a.bank_acc_no = b.id';
$data = $db->getRows($sql);
//var_dump($data);
foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';

//$english_format_number = number_format($number);


?>

						<tr>
							<td><span><?=$var['name'];?></span></td>
							<td><span><?=$var['dt'];?></span></td>
                            <td><span><?=number_format($var['amount']);?></span></td>
                            <td><span><?=$var['bank_name'];?></span></td>
							<td><span><?=$var['account_number'];?></span></td>
<!--							
                            <td><span><?=number_format($var['account_balance']);?></span></td>
							<td><span><?=$var['account_purpose'];?></span></td>
-->							
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