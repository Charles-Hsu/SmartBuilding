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

	if (count($_POST) > 0) {
		// ["assets-use-status"]=> string(9) "使用中" ["assets-watch"]=> string(0) "" ["assets-scrap-date"]=> string(0) ""
		$sql = "UPDATE assets SET status_no=" . $_POST['assets-use-status'] . " WHERE asset_no = '" . $_POST['assets-no'] . "'";
		$db->update($sql);
	}

	if ($_GET) {
		$asset_no = $_GET['asset_no'];
		$sql = 'SELECT a.*, b.name FROM assets a, asset_status b WHERE a.status_no = b.id AND asset_no = "' . $asset_no . '"';
		$data = $db->getRows($sql);
		$data = $data[0];
	}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="/smartbuilding/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/household.php">住戶管理</a>
				</li>
<!--
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/reserve.php">公共設施預約</a>
				</li>
-->
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/assets.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>編輯資產</span>
				</div>
				<div class="row justify-content-center">
					<div class="col-lg-8 col-md-10 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<span class="edit-title mb-3">資產資料</span>
<!--
							<div class="form-group row">
								<label for="community" class="text-right col-md-3 col-form-label">所屬社區:</label>
								<div class="col-md-9 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
-->
							<div class="form-group row">
								<label for="assets-no" class="text-right col-md-3 col-form-label">
									資產編號:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-no" id="assets-no" value="<?=$data['asset_no'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-name" class="text-right col-md-3 col-form-label">
									資產名稱:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-name" id="assets-name" value="<?=$data['asset_name'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-sort" class="text-right col-md-3 col-form-label">分類:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-sort" id="assets-sort" value="<?=$data['asset_category'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-price" class="text-right col-md-3 col-form-label">價格:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-price" id="assets-price" value="<?=$data['price'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-amount" class="text-right col-md-3 col-form-label">數量:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-amount" id="assets-amount" value="<?=$data['amount'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-man" class="text-right col-md-3 col-form-label">購置人:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-man" id="assets-man" value="<?=$data['order_by'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-buy-date" class="text-right col-md-3 col-form-label">
									購置日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="assets-buy-date" id="assets-buy-date" value="<?=substr($data['order_date'],0,10);?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-use-state" class="text-right col-md-3 col-form-label">
									使用狀態:
								</label>






								<div class="col-md-9">
									<select class="custom-select" name="assets-use-status">


<?php
$sql =  "SELECT * FROM asset_status";
$option = $db->getRows($sql);
foreach($option as $var) {
echo $var['name'];
echo $var['id'];
?>
									<option
									<?php if ($data['status_no'] == $var['id']) {
										echo 'selected';
									}
									?>
									value="<?=$var['id'];?>"><?=$var['name'];?></option>
<?php
}
?>
<!--

										<option selected>選取狀態</option>
										<option value="One">One</option>
										<option value="Two">Two</option>
										<option value="Three">Three</option>
-->
									</select>
								</div>
							</div>
							<span class="edit-title mb-3">資產移交</span>
							<div class="form-group row">
								<label for="assets-watch" class="text-right col-md-3 col-form-label">監交人:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-watch" id="assets-watch" placeholder="監交人...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-watch" class="text-right col-md-3 col-form-label">移交人:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-watch" id="assets-watch" placeholder="移交人...">
								</div>
							</div>
<!--
							<div class="form-group row">
								<label for="assets-use-state" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>使用狀態:
								</label>
								<div class="col-md-9">
									<select class="custom-select" name="assets-use-status">
										<option selected>選取狀態</option>
										<option value="One">One</option>
										<option value="Two">Two</option>
										<option value="Three">Three</option>
									</select>
								</div>
							</div>
-->
							<span class="edit-title mb-3">資產報廢</span>
							<div class="form-group row">
								<label for="assets-scrap-date" class="text-right col-md-3 col-form-label">
									報廢日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="assets-scrap-date" id="assets-scrap-date" placeholder="報廢日期..." >
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button class="btn btn-primary">儲存更新</button>
									<button class="btn btn-outline-secondary">取消更新</button>
									<button class="btn btn-outline-danger">刪除該資產</button>
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