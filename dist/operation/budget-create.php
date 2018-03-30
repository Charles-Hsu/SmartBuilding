<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 

$sql = 'SELECT a.id,a.account_name,a.bank_name,a.account_number,a.account_purpose,a.account_balance,b.type FROM bank_acc a, bank_acc_type b WHERE a.account_type = b.id';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);

session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
var_dump($data);
/*
if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}
*/
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
					<a class="nav-link" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/operation/budget.php">年度預算</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/operation/budget.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>年度預算</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
<!--							
							<div class="form-group row">
								<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
								<div class="col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
-->							
							<div class="form-group row">
								<label for="supplies-name" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>預算名稱:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-name" id="supplies-name">
								</div>
							</div>
<!--							
							<div class="form-group row">
								<label for="supplies-no" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>預算總類:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-no" id="supplies-no">
								</div>
							</div>
-->							
                            <div class="form-group row">
								<label for="supplies-brands" class="text-right col-md-4 col-form-label">
									預算金額:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-brands" id="supplies-brands">
								</div>
							</div>
							<div class="form-group row">
								<label for="supplies-standard" class="text-right col-md-4 col-form-label">
									預算帳戶:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-standard" id="supplies-standard">
								</div>
							</div>
							<div class="form-group row">
								<label for="supplies-standard" class="text-right col-md-4 col-form-label">
									編列年限:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="supplies-standard" id="supplies-standard">
								</div>
							</div>
<!--							
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
-->							
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