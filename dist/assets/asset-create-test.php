<?php 
include('../config.php');
include(Document_root.'/Header.php'); 

session_start();

$message = "";

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

if(count($_POST)>0) {
	
	echo 'assets-no = ' . $_POST['assets-no'] . '<br>';
	echo 'assets-name = ' . $_POST['assets-name'] . '<br>';
	echo 'assets-sort = ' . $_POST['assets-sort'] . '<br>';
	echo 'assets-price = ' . $_POST['assets-price'] . '<br>';
	echo 'assets-amount = ' . $_POST['assets-amount'] . '<br>';
	echo 'assets-man = ' . $_POST['assets-man'] . '<br>';
	echo 'assets-buy-date = ' . $_POST['assets-buy-date'] . '<br>';
	echo 'assets-use-stat = ' . $_POST['assets-use-stat'] . '<br>';

	$sql =  "SELECT count(*) AS n FROM assets WHERE asset_no='" . $_POST['assets-no']. "'";
	$data = $db->getValue($sql);

	if ($data != 0) {
		$message="資產編號重複";
	} else {
		$sql =  "SELECT count(*) AS n FROM assets WHERE asset_name='" . $_POST['assets-name']. "'";
		$data = $db->getValue($sql);
		if ($data != 0) {
			$message="資產名稱重複";
		}
	}

	if ($_POST['assets-no'] == "") {
		$message="資產編號不能空白";
	} else if ($_POST['assets-name'] == "") {
		$message="資產名稱不能空白";
	} else if ($_POST['assets-buy-date'] == "") {
		$message="請輸入購置日期";
	} else if ($_POST['assets-use-state'] == "") {
		$message="請選擇使用狀態";
	} else {
		$message="新增成功";
	}

}


$sql =  "SELECT asset_no,asset_name,asset_category FROM assets ORDER BY id DESC LIMIT 1";
$data = $db->getRows($sql);
//var_dump($data);
$data = $data[0];
//echo "...." . $data['asset_no'];
/*
foreach($data as $var) {
	echo $var['Name'];
	echo $var['id'];
}
var_dump($data);
*/
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="../assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="household.php">住戶管理</a>
				</li>
<!--				
				<li class="nav-item">
					<a class="nav-link" href="infrastructure.php">公共設施</a>
				</li>
-->				
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="../assets.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增資產</span> <!--回上一頁'資產管理'-->
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
								<label for="assets-no" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>資產編號:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-no" id="assets-no" value="<?=$data['asset_no'];?>" placeholder="資產編號...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-name" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>資產名稱:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-name" id="assets-name"  value="<?=$data['asset_name'];?>" placeholder="資產名稱...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-sort" class="text-right col-md-3 col-form-label">分類:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-sort" id="assets-sort" value="<?=$data['asset_category'];?>" placeholder="分類...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-price" class="text-right col-md-3 col-form-label">價格:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-price" id="assets-price" placeholder="價格..." value="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-amount" class="text-right col-md-3 col-form-label">數量:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-amount" id="assets-amount" placeholder="數量..." value="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-man" class="text-right col-md-3 col-form-label">購置人:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="assets-man" id="assets-man" placeholder="購置人...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-buy-date" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>購置日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="assets-buy-date" id="assets-buy-date" placeholder="購置日期..." >
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-use-state" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>使用狀態:
								</label>
								<div class="col-md-9">
									<select class="custom-select" name="assets-use-state">
										<option selected>選取狀態</option>

<?php
$sql =  "SELECT * FROM asset_status";
$data = $db->getRows($sql);
foreach($data as $var) {
//	echo $var['Name'];
//echo $var['id'];
?>
<!--
									<option value="<?=$var['id'];?>"><?=$var['Name'];?></option>
-->
<?php
}
?>

										<option value="One">One</option>
										<option value="Two">Two</option>
										<option value="Three">Three</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">新增</button>
									<button class="btn assets-btn assets-cancel-btn">取消</button>
								</div>
							</div>

<?php if($message!="") { ?>
                   		<div class="message"><?php echo $message; ?></div>
<?php } ?>



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