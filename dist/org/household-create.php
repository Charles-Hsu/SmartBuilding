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
					<a class="nav-link" href="<?= $urlName ?>/org/mails.php">郵件紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/org/household.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增住戶意見</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
								<div class="col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-title" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>標題:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-title" id="household-title">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-content" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>意見內容:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-content" id="household-content">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-reply" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>反應住戶:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-reply" id="household-reply">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-status" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>案件狀態:</label>
								<div class="col-md-8">
									<select class="form-control" name="household-status" id="household-status">
										<option value="" selected>選取狀態</option>
										<option value="unsucess">未結案</option>
										<option value="sucess">已結案</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-date" class="text-right col-md-4 col-form-label">
									結案日期:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="household-date" id="household-date">
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