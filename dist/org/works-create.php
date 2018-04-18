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
					<a class="nav-link" href="<?= $urlName ?>/org.php">人員</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>

                <!-- <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li> -->
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/org/works.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增工作日誌</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
								<div class="col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-workdate" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>工作日誌日期:</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="household-workdate" id="household-workdate">
								</div>
							</div><div class="form-group row">
								<label for="works-type" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>日誌類型:</label>
								<div class="col-md-8">
									<select class="form-control" name="works-type" id="works-type">
										<option value="" selected>選取日誌類型</option>
										<option value="">清潔</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="works-upload-label" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>檔案上傳:</label>
								<div class="col-md-8">
                                    <label for="works-upload" class="files-upload">
                                        <input name="works-upload" type="file" id="works-upload" class="form-control files-input" placeholder="點擊選擇欲上傳的檔案">
                                        <span class="files-name-box">
                                            <span class="files-name">點擊選擇欲上傳的檔案</span>
                                        </span>
                                    </label>
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