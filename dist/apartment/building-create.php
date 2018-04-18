<?php session_start(); ?>
<?php
	include('../config.php');
	include('../Header.php');

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
					<a class="nav-link active" href="<?= $urlName ?>/apartment/building.php">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment.php">基本資料</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/settings.php">參數設定</a>
                </li>
				<?php
					}
				?>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/apartment/building.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增社區建築</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
<!--
							<div class="form-group row">
								<label for="community" class="text-right col-md-3 col-form-label">所屬社區:</label>
								<div class="col-md-9 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
-->
							<div class="form-group row">
								<label for="builds-name" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>建物名稱:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="builds-name" id="builds-name" placeholder="建築物名稱...">
								</div>
							</div>
							<div class="form-group row">
								<label for="builds-address" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>建物地址:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="builds-address" id="builds-address" placeholder="建築物地址...">
								</div>
							</div>

							<div class="form-group row">
								<label for="builds-license-num" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>使用執照字號:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="builds-license-num" id="builds-license-num" placeholder="使用執照字號...">
								</div>
							</div>


							<div class="form-group row">
								<label for="builds-license" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>發照日期:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="builds-license" id="builds-license" placeholder="發照日期..." >
								</div>
							</div>
							<!-- <div class="form-group row">
								<label for="builds-yeaer" class="text-right col-md-4 col-form-label">使用年限:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="builds-yeaer" id="builds-yeaer" placeholder="建築物使用年限...">
								</div>
							</div> -->
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-outline-secondary">新增</button>
									<button class="btn btn-outline-secondary">取消</button>
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