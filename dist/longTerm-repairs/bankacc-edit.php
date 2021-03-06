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

<?php

$sql = '';

$table = 'bank_acc';
$id = 0;

if ($_GET) {
	$id = $_GET['id'];
}

if(count($_POST)>0) {

	//var_dump($_POST);
	$balance = $_POST['bankacc-balance'];
	$comment = $_POST['bankacc-note'];
	//echo $comment;
	//$comment = utf8_encode($comment);
	//echo $comment;


	$sql =  "UPDATE " . $table . " SET account_balance='" . $balance . "', comment = '" . $comment . "' WHERE id = " . $id;

	//echo $sql;

	$db->setCharset(utf8);
	$data = $db->exec($sql);

	//$sql = "update {$this->prename}member_cash set order_no='{$result['order_no']}',state=3 where id=?";
	//$this->update($sql, $id);


}


if ($_GET) {
	$id = $_GET['id'];
	//echo $license_no;
	$table = 'bank_acc';

	//$sql = 'SELECT a.*,b.type FROM bank_acc a, bank_acc_type b WHERE a.account_type = b.id';

	$sql = 'SELECT a.*, b.type AS acc_type FROM bank_acc a, bank_acc_type b WHERE a.id = "' . $id . '" AND a.account_type = b.id';
	//echo $sql;
	$data = $db->getRows($sql);
	$data = $data[0];
}

$data = $db->getRows($sql);
$data = $data[0];

//var_dump($data);

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/longTerm-repairs/budget.php">年度預算</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/longTerm-repairs/budget.php">財務籌措</a>
                </li>
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/longTerm-repairs/bank-acc.php">銀行專戶</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/longTerm-repairs/bank-acc.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>編輯銀行專戶</span>
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
								<label for="bankacc-use" class="text-right col-md-4 col-form-label">
									專戶用途:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-use" value="<?=$data['account_purpose'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="bankacc-type" class="text-right col-md-4 col-form-label">
									專戶類型:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-type" value="<?=$data['acc_type'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="bankaccount-name" class="text-right col-md-4 col-form-label">
									帳戶名稱:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="bankaccount-name" value="<?=$data['account_name'];?>" readonly>
								</div>
							</div>
<!--
							<div class="form-group row">
								<label for="bankacc-code" class="text-right col-md-4 col-form-label">
									銀行代碼:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-code" value="<?=$data['bank_no'];?>" readonly>
								</div>
							</div>
-->
							<div class="form-group row">
								<label for="bank-name" class="text-right col-md-4 col-form-label">
									銀行名稱:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bank-name" value="<?=$data['bank_name'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="bankacc-account" class="text-right col-md-4 col-form-label">
									銀行帳號:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-account" value="<?=$data['account_number'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="bankacc-balance" class="text-right col-md-4 col-form-label">
									銀行餘額:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-balance" value="<?=number_format($data['account_balance']);?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="bankacc-note" class="text-right col-md-4 col-form-label">
									備註:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-note" value="<?=$data['comment'];?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-primary">儲存更新</button>
									<button class="btn btn-outline-secondary">取消更新</button>
<!--
									<button class="btn btn-outline-danger">刪除該建築</button>
-->
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