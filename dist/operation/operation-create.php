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
					<a class="nav-link active" href="<?= $urlName ?>/operation.php">例行作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/#">年度預算</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/operation.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增例行作業</span>
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
								<label for="operation-project" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>作業項目:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="operation-project" id="operation-project">
								</div>
							</div>
							<div class="form-group row">
								<label for="operation-type" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>作業類別:</label>
								<div class="col-md-8">
									<select id="operation-type" class="form-control" name="operation-type">
                                        <option value="" selected>選擇作業類別</option>
                                        <option value="">清潔</option>
                                    </select>
								</div>
                            </div>
                            <div class="form-group row">
								<label for="operation-cycle" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>作業週期:</label>
								<div class="col-md-8">
									<select id="operation-cycle" class="form-control" name="operation-cycle">
                                        <option value="" selected>選擇作業週期</option>
                                        <option value="">年</option>
                                        <option value="">週</option>
                                        <option value="">月</option>
                                        <option value="">日</option>
                                    </select>
								</div>
                            </div>
							<div class="form-group row">
								<label for="operation-amount" class="text-right col-md-4 col-form-label">
									作業金額:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="operation-amount" id="operation-amount">
								</div>
							</div>
							<div class="form-group row">
								<label for="operation-contractor" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>承包廠商:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="operation-contractor" id="operation-contractor">
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-company" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>作業內容:
								</label>
								<div class="col-md-8">
									<textarea  class="form-control" name="orgstaff-company" id="orgstaff-company" cols="10" rows="10"></textarea>
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