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
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation.php">例行作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/#">年度預算</a>
                </li>
			</ul>
			<div id="assets-tab" class="row mr-0 ml-0">
				<div class="repairs-menu col-2">
					<ul class="repairs-menu-bar d-flex flex-column align-items-center">
						<li><a href="<?= $urlName ?>/operation/repairs-normal.php" class="active">一般維修</a></li>
						<li><a href="<?= $urlName ?>/operation/repairs-abnormal.php" class="">異常回報</a></li>
					</ul>
				</div>
				<div class="repairs-content col-10">
					<div class="assets-create-title mb-3">
						<a href="<?= $urlName ?>/operation/repairs-normal.php" class="assets-create-icon fas fa-chevron-left"></a>
						<span>編輯一般維修</span>
					</div>
					<div class="row justify-content-lg-start justify-content-center">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-12">
							<form class="assets-create-form" action="" method="POST">
								<div class="form-group row">
									<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
									<div class="col-md-8 d-flex align-items-center">
										<span>XXXXXX</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="repairs-contractor" class="text-right col-md-4 col-form-label">
										<span class="important">*</span>承包廠商:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="repairs-contractor" id="repairs-contractor">
									</div>
								</div>
								<div class="form-group row">
									<label for="repairs-content" class="text-right col-md-4 col-form-label">
										<span class="important">*</span>維修內容:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="repairs-content" id="repairs-content">
									</div>
								</div>
								<div class="form-group row">
									<label for="repairs-amount" class="text-right col-md-4 col-form-label">
										<span class="important">*</span>維修金額:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="repairs-amount" id="repairs-amount">
									</div>
								</div>
								<div class="form-group row">
									<label for="repairs-date" class="text-right col-md-4 col-form-label">
										<span class="important">*</span>故障發生時間:</label>
									<div class="col-md-8">
										<input type="text" class="form-control datepicker" name="repairs-date" id="repairs-date">
									</div>
								</div>
								<div class="form-group row">
									<label for="repairs-expecteddate" class="text-right col-md-4 col-form-label">
										預計維修完成時間:
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control datepicker" name="repairs-expecteddate" id="repairs-expecteddate">
									</div>
								</div>
								<div class="form-group row">
									<label for="repairs-finishdate" class="text-right col-md-4 col-form-label">
										實際維修完成時間:
									</label>
									<div class="col-md-8">
										<input type="text" class="form-control datepicker" name="repairs-finishdate" id="repairs-finishdate">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-8 offset-md-4">
										<button class="btn btn-primary">儲存更新</button>
										<button class="btn btn-outline-secondary">取消更新</button>
										<button class="btn btn-outline-danger">刪除該人員</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include(Document_root.'/Footer.php');
?>