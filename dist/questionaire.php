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
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<div id="assets-tab">
				<a href="#" class="btn add-asset-btn mb-3">
					<span>+</span>填寫問卷
				</a>
				<!-- <form action="" method="POST">
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
				</form> -->
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