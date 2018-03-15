<?php 
include('../config.php');
include(Document_root.'/Header.php'); 
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
					<a class="nav-link active" href="/smartbuilding/assets/reserve.php">公共設施預約</a>
				</li>
			</ul>
			<div id="assets-tab">
				<a href="/smartbuilding/assets/reserve-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增預約公設
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>預約時段</th>
							<th>預約公設名稱</th>
							<th>登記人</th>
							<th>費用</th>
							<th>編輯</th>
						</tr>
					</thead>
					<tbody>
<?php
	//foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>

						<tr>
							<td><span>2018-03-09 19:04 至 2018-03-10 20:00</span></td>
							<td><span>游泳池 - SPA池</span></td>
							<td><span>Joe</span></td>
							<td><span>20</span></td>
							<td><a href="/smartbuilding/assets/edit-page.php" class="btn btn-outline-secondary">編輯</a></td>
						</tr>
						<tr>
							<td><span>2018-04-19 16:04 至 2018-04-20 21:00</span></td>
							<td><span>健身房</span></td>
							<td><span>Cena</span></td>
							<td><span>200</span></td>
							<td><a href="/smartbuilding/assets/edit-page.php" class="btn btn-outline-secondary">編輯</a></td>
						</tr>
<?php
	//}
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