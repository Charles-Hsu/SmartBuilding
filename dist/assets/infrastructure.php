<?php 
include('../config.php');
include(Document_root.'/Header.php'); 
?>
<?php 

$sql = 'SELECT * FROM infra';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);

if (strlen($_SESSION['account']) == 0) {
	echo 
	'<script>
		//document.onkeypress=function(e) {
			//alert("You pressed a key inside the input field");
			//document.getElementById("demo").innerHTML = 5 + 6;
			//window.location.href = "http://stackoverflow.com";
			window.location.href = "./login.php";
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
					<a class="nav-link" href="/smartbuilding/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/household.php">住戶管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">公共設施</a>
				</li>
			</ul>
			<div id="assets-tab">
				<a href="/smartbuilding/assets/infra-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增公設
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>編號</th>
							<th>公設名稱</th>
							<th>編輯</th>
						</tr>
					</thead>
					<tbody>
<?php
	foreach($data as $var) {
?>

						<tr>
							<td><span><?=$var[id]?></span></td>
							<td><span><?=$var[name]?></span></td>
							<td><a href="/smartbuilding/assets/infra-edit.php" class="btn btn-outline-secondary">修改/預約</a></td>
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
	"search": {
		"search": ""
	},
	"columnDefs": [
	    { "searchable": false, "targets": 1 },
	    { "searchable": false, "targets": 2 },
	    { "searchable": false, "targets": 3 },
	],
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "請輸入日期...",
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