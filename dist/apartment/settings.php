<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);

if (count($_POST)) {
	$holder_meeting_num = $_POST['holder-meeting-num'];
	$committee_meeting_num = $_POST['committee-meeting-num'];
	$op_man_num = $_POST['op-man-num'];
	$op_patrol_num = $_POST['op-patrol-num'];
	$sql = "UPDATE apartment_settings SET holder_meeting_num = $holder_meeting_num, committee_meeting_num = $committee_meeting_num, op_man_num = $op_man_num, op_patrol_num = $op_patrol_num";
	$data = $db->update($sql);
}


?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment.php">基本資料</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/building.php">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/public-util.php">公共設施</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/meeting-man.php">會議管理</a>
				</li>				
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/meeting-resolution.php">決議事項</a>
				</li>								
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/apartment/settings.php">規約設定</a>
                </li>			
			</ul>
			<?php
				$sql = "SELECT * FROM `apartment_settings`";
				$data = $db->getRow($sql);
			?>
			<div id="assets-tab" class="d-flex flex-column px-3">
				<form action="" class="col-md-8 col-sm-12" method="POST">
					<div class="form-group row">
						<label class="col-md-4 col-sm-4 col-form-label text-right pr-3">
							區權會召開次數(每年):
						</label>
						<input type="number" class="form-contorl col-md-8 col-sm-8" name="holder-meeting-num" value="<?php echo $data['holder_meeting_num']; ?>">
					</div>
					<div class="form-group row">
						<label for="apartment-address" class="col-md-4 col-sm-4 col-form-label text-right pr-3">
							管委會召開次數(每月):
						</label>
						<input type="number" class="form-contorl col-md-8 col-8" name="committee-meeting-num" value="<?php echo $data['committee_meeting_num']; ?>">
					</div>

					<div class="form-group row">
						<label for="apartment-address" class="col-md-4 col-sm-4 col-form-label text-right pr-3">
							現場主管編制人數:
						</label>
						<input type="number" class="form-contorl col-md-8 col-8" name="op-man-num" value="<?php echo $data['op_man_num']; ?>">
					</div>

					<div class="form-group row">
						<label for="apartment-address" class="col-md-4 col-sm-4 col-form-label text-right pr-3">
							現場保全員編制人數:
						</label>
						<input type="number"  class="form-contorl col-md-8 col-8" name="op-patrol-num" value="<?php echo $data['op_patrol_num']; ?>">
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
		/*
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋資產...",
		*/
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
	"searching": false,
	"deferRender": true,
	"processing": true,
	"ordering": false,
})
</script>
<?php include('../Footer.php'); ?>