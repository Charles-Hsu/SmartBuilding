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
					<a class="nav-link" href="<?= $urlName ?>/operation/energy.php">節約能源</a>
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
					<a class="nav-link active" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <?php
					}
                ?>
			</ul>

			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/operation/supplies.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>編輯耗材</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<!-- <div class="form-group row">
								<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
								<div class="col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div> -->
							<div class="form-group row">
								<label for="supplies-name" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>耗材名稱:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-name" id="supplies-name">
								</div>
							</div>
							<div class="form-group row">
								<label for="supplies-no" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>耗材編號:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-no" id="supplies-no">
								</div>
							</div>
                            <div class="form-group row">
								<label for="supplies-brands" class="text-right col-md-4 col-form-label">
									品牌:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-brands" id="supplies-brands">
								</div>
							</div>
							<div class="form-group row">
								<label for="supplies-standard" class="text-right col-md-4 col-form-label">
									規格:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-standard" id="supplies-standard">
								</div>
							</div>
							<div class="form-group row">
								<label for="supplies-unit" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>單位:</label>
								<div class="col-md-8">
									<select id="supplies-unit" name="supplies-unit" class="form-control">
										<option value="" selected>請選擇單位</option>
										<option value="">根</option>
										<option value="">個</option>
										<option value="">條</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="supplies-num" class="text-right col-md-4 col-form-label">
									數量:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-num" id="supplies-num">
								</div>
							</div>
							<div class="form-group row">
								<label for="supplies-amonut" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>價格:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-amonut" id="supplies-amonut">
								</div>
							</div>
							<div class="form-group row">
								<label for="supplies-note" class="text-right col-md-4 col-form-label">
									備註:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-note" id="supplies-note">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-primary">儲存更新</button>
									<button class="btn btn-outline-secondary">取消更新</button>
									<!-- <button class="btn btn-outline-danger">刪除該人員</button> -->
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