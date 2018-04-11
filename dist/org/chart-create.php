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
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/household.php">住戶意見</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/works.php">工作日誌</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/mails.php">郵件紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/org/chart.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增委員</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="chart-session" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>屆別:</label>
								<div class="col-md-8">
									<select  class="form-control" name="chart-session" id="chart-session">
										<option value="" selected>請選擇屆別</option>
										<option value="">第一屆</option>
										<option value="">第二屆</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="chart-note" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>備註:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="chart-note" id="chart-note">
								</div>
							</div>
							<div class="form-group row">
								<label for="mails-upload" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>檔案上傳:</label>
								<div class="col-md-8">
                                    <label for="mails-upload" class="files-upload">
                                        <input name="mails-upload" type="file" id="mails-upload" class="form-control files-input" placeholder="">
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