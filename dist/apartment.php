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
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/mails.php">郵件紀錄</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/public-util.php">公設預約</a>
				</li>
				<?php
					if ($_isAdmin) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/meeting-man.php">會議管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/building.php">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/apartment.php">基本資料</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/settings.php">參數設定</a>
                </li>
				<?php
					}
				?>
			</ul>


			<?php

			$sql = 'SELECT * FROM apartment';
			$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

			$data = $db->getRows($sql);
			$data = $data[0];
			?>
			<div id="assets-tab" class="d-flex flex-column px-3">
				<form action="" class="col-md-8 col-sm-12">
					<div class="form-group row">
						<label for="apartment-name" class="col-md-4 col-sm-4 col-form-label text-right pr-3">
							社區名稱:
						</label>
						<input type="text" id="apartment-name" class="form-contorl col-md-8 col-sm-8" name="apartment-name" value="<?= $data['name']; ?>">
					</div>
					<div class="form-group row">
						<label for="apartment-address" class="col-md-4 col-sm-4 col-form-label text-right pr-3">
							社區地址:
						</label>
						<input type="text" id="apartment-address" class="form-contorl col-md-8 col-8" name="apartment-address" value="<?= $data['address']; ?>">
					</div>
					<div class="form-group row">
						<div class="col-md-8 offset-md-4 col-12">
							<button class="btn btn-primary">更新資料</button>
						</div>
					</div>
				</form>
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