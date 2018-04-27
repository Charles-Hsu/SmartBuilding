<?php session_start(); ?>
<?php
	include('../config.php');
	include('../Header.php');
	if (!$_SESSION['online']) {
		$url = "$urlName/login.php";
		header("Location: " . $url);
	}
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
	$_isAdmin = $_SESSION['admin'];
?>

<?php

	if (COUNT($_POST)) {
		$dt = $_POST["energy-date"];
		$yyyy = substr($dt, 0, 4);
		$mm = substr($dt, 5, 2);
		$yyyymm = $yyyy . $mm;
		// echo $yyyymm;
		$fee = $_POST['energy-fee'];
		// echo $fee;
		$sql = "INSERT INTO elect_fee (`yyyymm`, `fee`) VALUES ('$yyyymm', '$fee')";
		$db->insert($sql);
		echo $sql;
	}


?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
			 	<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/operation/energy.php">節約能源</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation.php">例行作業</a>
				</li>
				<?php
          if ($_isAdmin) {
        ?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
        </li>
        <?php
					}
        ?>
			</ul>

			<!-- <div class="energy-col mb-3">
				<div class="card h-100">
					<div class="card-header">節約能源</div>
					<div class="card-body h-100">
						<canvas id="energy-chart"></canvas>
					</div>
				</div>
			</div> -->

			<div id="assets-tab">

				<div class="assets-create-title mb-3">
					<a href="./energy.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增電費</span> <!--回上一頁'資產管理'-->
				</div>

				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="post-create-form" id="post-create-form" action="" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="post-date" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="energy-date" id="energy-date" placeholder="日期..." >
								</div>
							</div>
              <div class="form-group row">
								<label for="assets-no" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>電費金額:</label>
								<div class="col-md-9">
                  <input type="text" name="energy-fee" placeholder="電費金額...">
                </div>
							</div>
 							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">確認</button>
									<button class="btn assets-btn assets-cancel-btn">取消</button>
								</div>
							</div>
            </form>
					</div>
				</table>
			</div>
		</div>
	</div>
</div>

<script>

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd < 10){
    dd = '0' + dd;
}
if(mm < 10){
    mm = '0' + mm;
}
var today = yyyy + '-' + mm + '-' + dd;

$(document).ready(function() {
    $('#energy-date').attr("value", today);
});



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
	"processing": true,
	"order": [[0, 'desc']],
})

</script>
<?php include('../Footer.php'); ?>