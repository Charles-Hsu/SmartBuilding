<?php 
include('./config.php');
include('./Header.php'); 
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
        <!--
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/operation.php">例行作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/#">年度預算</a>
                </li>
			</ul>
        -->            
			<div id="assets-tab">
            
				<a href="#" class="btn add-asset-btn mb-3">
					<span></span>作業紀錄
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
                            <th>作業時間</th>
							<th>作業類別</th>
							<th>作業項目</th>
							<th>作業人員</th>
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
							<td><span>2018/3/19 09:30</span></td>
							<td><span>組織管理</span></td>
							<td><span>新增人員 Joe Lee</span></td>
							<td><span>易入門股份有限公司</span></td>
						</tr>
						<tr>
							<td><span>2018/3/21 18:12</span></td>
							<td><span>清潔</span></td>
							<td><span>清理忠孝樓</span></td>
							<td><span>素環清有限公司</span></td>
						</tr>
						<tr>
							<td><span>2018/3/21 18:22</span></td>
							<td><span>會議</span></td>
							<td><span>管委會開會</span></td>
							<td><span>管委會</span></td>
						</tr>                        
						<tr>
							<td><span>2018/3/22 08:12</span></td>
							<td><span>資產管理</span></td>
							<td><span>新增增產測試資產A</span></td>
							<td><span>八萬一管理公司</span></td>
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
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋紀錄...",
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