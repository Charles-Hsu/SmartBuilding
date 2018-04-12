<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 

$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);


if ($_GET) {
	$license_no = $_GET['license_no'];
	//echo $license_no;
	$table = 'building';
	$sql = 'SELECT * FROM ' . $table . ' WHERE license_no = "' . $license_no . '"';
	//echo $sql;
	$data = $db->getRows($sql);
	$data = $data[0];
}

$data = $db->getRows($sql);
$data = $data[0];
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);

if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
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
					<a class="nav-link active" href="<?= $urlName ?>/apartment/building.php">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/public-util.php">公共設施</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/settings.php">規約設定</a>
                </li>			
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/apartment/building.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>編輯社區建築</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
						<div class="form-group row">
								<label for="builds-name" class="text-right col-md-4 col-form-label">
									建物名稱:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value=<?=$data['name'];?> >
								</div>
							</div>
							<div class="form-group row">
								<label for="builds-address" class="text-right col-md-4 col-form-label">
									建物地址:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value=<?=$data['address'];?> >
								</div>
							</div>

							<div class="form-group row">
								<label for="builds-license-num" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>使用執照字號:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="builds-license-num"  value=<?=$data['license_no'];?> readonly>
								</div>
							</div>


							<div class="form-group row">
								<label for="builds-license" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>發照日期:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="builds-license" value=<?=$data['approved_date'];?> readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="builds-yeaer" class="text-right col-md-4 col-form-label">使用年限:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="builds-yeaer"  value=<?=$data['expired_years'];?>>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-primary">儲存更新</button>
									<button class="btn btn-outline-secondary">取消更新</button>
<!--									
									<button class="btn btn-outline-danger">刪除該建築</button>
-->									
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
include(Document_root.'/Footer.php');
?>