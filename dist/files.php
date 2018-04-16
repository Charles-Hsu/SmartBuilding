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

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="files-wrapper">
			<div id="assets-tab">
				<a href="./files/files-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增檔案
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>文件種類</th>
							<th>文件名稱</th>
							<th>檔案名稱</th>
							<th>下載</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT a.desc,a.path,b.type,b.id FROM files a, file_type b WHERE a.type = b.id";
							// echo $sql;
							$data = $db->getRows($sql);
							foreach($data as $var) {
						?>
						<tr>
							<td><span><?php echo $var['type']; ?></span></td>
							<td><span><?php echo $var['desc']; ?></span></td>
							<td><span><?php echo $var['path']; ?></span></td>
							<!-- <td><a href="<?php echo $var['id']/$var['path']; ?>" class="btn btn-primary" download>開啟檔案</a></td> -->
							<td><a href="<?php echo "files/". $var['id'] . "/" . $var['path'];   ?>">開啟檔案</a></td>
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
        "columnDefs": [
            { "searchable": false, "targets": 1 },
            { "searchable": false, "targets": 2 },
        ],
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋文件名稱...",
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