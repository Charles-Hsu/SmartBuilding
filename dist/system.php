<?php session_start(); ?>
<?php
	include('./config.php');
	include('./Header.php');
	if (!$_SESSION['online']) {
		$url = "./login.php";
		header("Location: " . $url);
	}
	$_isAdmin = $_SESSION['admin'];
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

	$range = 1; // default
	if (COUNT($_POST)) {
		// var_dump($_POST);
		$range = $_POST['range'];
		$from = date('Y-m-d', strtotime("-" . $range . " days"));
		$sql = "SELECT dt,ip,username,message FROM system_log WHERE dt > '$from'";
		// echo $sql;
		$data = $db->getRows($sql);
		// var_dump($data);
	}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">

			<div id="assets-tab">

				<a href="#" class="btn add-asset-btn mb-3">
					<span>+</span>作業紀錄
				</a>

				<form action="" method="POST">
					<div>
						<?php if($range==1) {$checked = "checked";} else {$checked = "";}?>
						<input type="radio" name="range" value="1" <?php echo $checked;?>>當天
					</div>
					<div>
						<?php if($range==3) {$checked = "checked";} else {$checked = "";}?>
						<input type="radio" name="range" value="3" <?php echo $checked;?>>三天
					</div>
					<div>
						<?php if($range==7) {$checked = "checked";} else {$checked = "";}?>
						<input type="radio" name="range" value="7" <?php echo $checked;?>>當週
					</div>
					<div>
						<?php if($range==31) {$checked = "checked";} else {$checked = "";}?>
						<input type="radio" name="range" value="31" <?php echo $checked;?>>一個月
					</div>
					<div>
						<span>
							<input type="submit" value="確認">
						</span>
					</div>
				</form>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
                            <th>時間</th>
							<th>主機</th>
							<th>帳號</th>
							<th>內容</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($data as $var) {
						?>
						<tr>
							<td><span><?php echo $var['dt'];?></span></td>
							<td><span><?php echo $var['ip'];?></span></td>
							<td><span><?php echo $var['username'];?></span></td>
							<td><span><?php echo $var['message'];?></span></td>
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