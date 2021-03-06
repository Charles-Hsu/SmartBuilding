<?php
session_start();

include('../config.php');
include('../Header.php');

if (!$_SESSION['online']) {
	$url = "$urlName/login.php";
	header("Location: " . $url);
}

?>
<?php

$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);

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
					<a class="nav-link" href="<?= $urlName ?>/org/#">勤務管理</a>
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
					<span>編輯郵件紀錄</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
								<div class="col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
							<div class="form-group row">
								<label for="mails-date" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>郵件紀錄日期:</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="mails-date" id="mails-date">
								</div>
							</div><div class="form-group row">
								<label for="mails-records" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>登錄件數:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="mails-records" id="mails-records">
								</div>
							</div>
							<div class="form-group row">
								<label for="mails-list" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>清冊件數:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="mails-list" id="mails-list">
								</div>
							</div>
							<div class="form-group row">
								<label for="mails-upload" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>檔案上傳:</label>
								<div class="col-md-8">
                                    <label for="mails-upload" class="files-upload">
                                        <input name="mails-upload" type="file" id="mails-upload" class="form-control files-input" placeholder="點擊選擇欲上傳的檔案">
                                        <span class="files-name-box">
                                            <i class="fas fa-upload"></i>
                                            <span class="files-name"></span>
                                        </span>
                                    </label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
                                    <a href="#">smartbuilding.sql</a>
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
<?php
include(Document_root.'/Footer.php');
?>