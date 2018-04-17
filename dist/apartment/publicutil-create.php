<?php session_start(); ?>
<?php
	include('../config.php');
	include('../Header.php');
	$_isAdmin = $_SESSION['admin'];
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
	$pre_url = "$urlName/apartment";
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="#">郵件紀錄</a>
                </li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo $pre_url . "/public-util.php";?>">公設預約</a>
				</li>
				<?php
					if ($_isAdmin) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/meeting-man.php";?>">會議管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/building.php";?>">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . ".php";?>">基本資料</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/settings.php";?>">參數設定</a>
                </li>
				<?php
					}
				?>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/apartment/public-util.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增公共設施</span>
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
								<label for="publicutil-name" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>公共設施名稱:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="publicutil-name" id="publicutil-name" placeholder="公共設施名稱...">
								</div>
							</div>
							<div class="form-group row">
								<label for="publicutil-amount" class="text-right col-md-4 col-form-label">費用:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="publicutil-amount" id="publicutil-amount" placeholder="費用...">
								</div>
							</div>
							<div class="form-group row">
								<label for="publicutil-note" class="text-right col-md-4 col-form-label">備註:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="publicutil-note" id="publicutil-note" placeholder="備註...">
								</div>
							</div>
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