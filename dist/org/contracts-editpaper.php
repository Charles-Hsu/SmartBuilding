<?php
include('../config.php');
include('../Header.php');
?>
<?php

$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);

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
					<a class="nav-link" href="<?= $urlName ?>/org.php">人員</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/#">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
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
					<a href="<?= $urlName ?>/org/contracts-create.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增廠商合約</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="GET">
							<div class="form-group row">
								<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
								<div class="col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
                            <div class="form-group row">
								<label for="paper-title" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>合約標題:</label>
                                <div class="col-md-8">
									<input type="text" class="form-control" name="paper-title" id="paper-title">
								</div>
							</div>
							<div class="form-group row">
								<label for="paper-upload-label" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>檔案上傳:</label>
								<div class="col-md-8">
                                    <label for="paper-upload" class="files-upload">
                                        <input name="paper-upload" type="file" id="paper-upload" class="form-control files-input" multiple="multiple" placeholder="點擊選擇欲上傳的檔案">
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