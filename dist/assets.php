<?php 
include('./config.php');
include('./Header.php'); 
?>
<?php 
//$sql = 'SELECT a.*, b.name FROM assets a, asset_status b WHERE a.status_no = b.id AND asset_no = "' . $asset_no . '"';
$sql = 'SELECT a.*, b.name AS status, c.category AS cat FROM assets a, asset_status b, asset_category c WHERE a.status_no = b.id AND c.id=a.asset_category';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);

if (strlen($_SESSION['account']) == 0) {
	echo 
	'<script>
		//document.onkeypress=function(e) {
			//alert("You pressed a key inside the input field");
			//document.getElementById("demo").innerHTML = 5 + 6;
			//window.location.href = "http://stackoverflow.com";



			//window.location.href = "./login.php";


		//}
	</script>';
}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="/smartbuilding/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/household.php">產權管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/sellrent.php">租售管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/brokerman.php">帶看管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/hoa_fee.php">管理費</a>
				</li>

				<!--
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/infrastructure.php">公共設施</a>
				</li>
-->
			</ul>
			<div id="assets-tab">
				<a href="./assets/asset-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增資產
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>資產編號</th>
							<th>資產名稱</th>
							<th>資產類別</th>
							<th>使用狀態</th>
							<th>價格</th>
							<th>數量</th>
							<th>編輯</th>
						</tr>
					</thead>
					<tbody>
<?php
	foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>

						<tr>
							<td><span><?=$var[asset_no]?></span></td>
							<td><span><?=$var[asset_name]?></span></td>
							<td><span><?=$var[cat]?></span></td>
							<td><span><?=$var[status]?></span></td>
							<td><span><?=number_format($var[price])?></span></td>
							<td><span><?=$var[amount]?></span></td>
							<td><a href="/smartbuilding/assets/asset-edit.php?asset_no=<?=$var[asset_no]?>" class="btn btn-outline-secondary">修改</a></td>
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
<?php include('./Footer.php'); ?>
