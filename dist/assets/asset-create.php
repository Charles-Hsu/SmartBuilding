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
	if(count($_POST)>0) {
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
	//echo " message = [" . $message . "]";
	if ($message == "") {
		if ($_POST['assets-no'] == "") {
			$message="資產編號不能空白";
		} else if ($_POST['assets-name'] == "") {
			$message="資產名稱不能空白";
		} else if ($_POST['assets-buy-date'] == "") {
			$message="請輸入購置日期";
		} else if ($_POST['assets-use-state'] == "") {
			$message="請選擇使用狀態";
		} else {
/*
			echo 'assets-no = ' . $_POST['assets-no'] . '<br>';
			echo 'assets-name = ' . $_POST['assets-name'] . '<br>';
			echo 'assets-sort = ' . $_POST['assets-sort'] . '<br>';
			echo 'assets-price = ' . $_POST['assets-price'] . '<br>';
			echo 'assets-amount = ' . $_POST['assets-amount'] . '<br>';
			echo 'assets-man = ' . $_POST['assets-man'] . '<br>';
			echo 'assets-buy-date = ' . $_POST['assets-buy-date'] . '<br>';
			echo 'assets-use-state = ' . $_POST['assets-use-state'] . '<br>';
*/
			$table = 'assets';
			$data = array();
			$data['asset_no'] = $_POST['assets-no'];
			$data['asset_name'] = $_POST['assets-name'];
			$data['asset_category'] = $_POST['assets-sort'];
			$data['price'] = $_POST['assets-price'];
			$data['amount'] = $_POST['assets-amount'];
			$data['order_by'] = $_POST['assets-man'];
			$data['order_date'] = $_POST['assets-buy-date'];
			$data['status_no'] = $_POST['assets-use-state'];

			$fields = "";
			$values = "";

			foreach ($data as $key => $value) {
//				echo $key;
//				echo $value;
				$fields = $fields . "`" . $key . "`,";
				$values = $values . "'" . $value . "',";
			}
/*
			echo "<br>";
			echo $fields;
			echo "<br>";
			echo $values;
			echo "<br>";
			echo strlen($fields)-1;
			echo "<br>";
			//echo substr($fields, 0, strlen($fields)-1);
*/
			$fields = substr($fields, 0, strlen($fields)-1);
/*
			echo $fields;
			echo "<br>";
			echo strlen($values)-1;
			echo "<br>";
			//echo substr($values, 0, strlen($values)-1);
*/
			$values = substr($values, 0, strlen($values)-1);
/*
			echo "<br>";
*/
			$sql = 'INSERT INTO ' . $table . ' (' . $fields . ') ' . ' VALUES (' . $values . ')';
/*
			echo $sql;
*/
			if ($db->insert($sql)) {
			//if ($db->insertRow($table, $data)) {
				$message="新增成功";
			}
		}
	}

}

/*
	public function insertRow($table, $data){
		$sql="insert into $table(";
		$values='';
		foreach($data as $key=>$val){
			if($values){
				$sql.=', ';
				$values.=', ';
			}
			$sql.="`$key`";
			$values.=":$key";
		}
		$sql.=") values($values)";

		return $this->insert($sql, $data);
	}
*/

$sql =  "SELECT asset_no,asset_name,asset_category FROM assets ORDER BY id DESC LIMIT 1";
$data = $db->getRows($sql);

$data = $data[0];
//var_dump($data);
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
					<a class="nav-link active" href="/smartbuilding/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/household.php">產權管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/sellrent.php">租售管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/brokerman.php">帶看管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/hoa_fee.php">管理費</a>
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
								<label for="assets-use-state" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>分類:
								</label>
								<div class="col-md-9">
									<select class="custom-select" name="assets-use-state">
<!--
										<option selected>選取狀態</option>
-->
<?php
$sql =  "SELECT * FROM asset_category";
$data1 = $db->getRows($sql);
foreach($data1 as $var) {
//	echo $var['Name'];
//echo $var['id'];
?>
									<option value="<?=$var['id'];?>"><?=$var['category'];?></option>
<?php
}
?>
<!--

										<option value="One">One</option>
										<option value="Two">Two</option>
										<option value="Three">Three</option>
-->
									</select>
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
<!--
										<option selected>選取狀態</option>
-->
<?php
$sql =  "SELECT * FROM asset_status";
$data = $db->getRows($sql);
foreach($data as $var) {
//	echo $var['Name'];
//echo $var['id'];
?>
									<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
<?php
}
?>
<!--

										<option value="One">One</option>
										<option value="Two">Two</option>
										<option value="Three">Three</option>
-->
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