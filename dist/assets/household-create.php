<?php 
include('../config.php');
include(Document_root.'/Header.php'); 

session_start();

$message = "";

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

if(count($_POST)>0) {

	var_dump($_POST);

	$data = array();

	$data['building'] = $_POST['household-area'];
	$data['purpose'] = $_POST['household-use'];
	$data['status'] = $_POST['household-status'];
	$data['addr_no'] = $_POST['household-num'];
	$data['floor'] = $_POST['household-floor'];
	$data['holder'] = $_POST['household-own'];
	$data['resident'] = $_POST['household-name'];
	$data['owner_percentage'] = $_POST['household-props'];
	$data['space'] = $_POST['household-sqft'];
	$data['house_type'] = $_POST['household-style'];
	$data['due'] = $_POST['household-guard-amount'];
	$data['parking_lot_due'] = $_POST['household-park-amoun'];
	$data['buy_date'] = $_POST['assets-buy-date'];
	$data['used_for'] = $_POST['assets-use-state'];

	$fields = "";
	$values = "";

	foreach ($data as $key => $value) {
		$fields = $fields . "`" . $key . "`,";
		$values = $values . "'" . $value . "',"; 
	}

	$fields = substr($fields, 0, strlen($fields)-1);
	$values = substr($values, 0, strlen($values)-1);
	$sql = 'INSERT INTO household (' . $fields . ') ' . ' VALUES (' . $values . ')';
	echo $sql;
	
	if ($db->insert($sql)) {
	//if ($db->insertRow($table, $data)) {
		$message="新增成功";
	}


/*
	$sql =  "SELECT count(*) AS n FROM household WHERE asset_no='" . $_POST['assets-no']. "'";
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
				$fields = $fields . "`" . $key . "`,";
				$values = $values . "'" . $value . "',"; 
			}

			$fields = substr($fields, 0, strlen($fields)-1);
			$values = substr($values, 0, strlen($values)-1);
			$sql = 'INSERT INTO ' . $table . ' (' . $fields . ') ' . ' VALUES (' . $values . ')';
			echo $sql;
			
			if ($db->insert($sql)) {
			//if ($db->insertRow($table, $data)) {
				$message="新增成功";
			}
		}
	}
	*/
}


?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="/smartbuilding/assets/household.php">物件管理</a>
				</li>
<!--				
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/infrastructure.php">公共設施</a>
				</li>
-->				
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/assets/household.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增物件</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
<!--							
							<div class="form-group row">
								<label for="community" class="text-right col-lg-6 col-md-3 col-form-label">所屬社區:</label>
								<div class="col-lg-6 col-md-9 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
-->							
							<div class="form-group row">
								<label for="household-area" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>所屬大樓:</label>
								<div class="col-lg-6 col-md-9">
									<select name="household-area" id="household-area" class="form-control">

<?php
$sql =  "SELECT name FROM building";
$data = $db->getRows($sql);
foreach($data as $var) {
//	echo $var['Name'];
//echo $var['id'];
?>
									<option value="<?=$var['name'];?>"><?=$var['name'];?></option>
<?php
}
?>
<!--
										<option value="" selected>選擇大樓</option>
										<option value="AA">忠孝樓</option>
										<option value="BB">仁愛樓</option>
-->										
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-use" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>房子用途:</label>
								<div class="col-lg-6 col-md-9">
									<select name="household-use" id="household-use" class="form-control">
<!--									
										<option value="" selected>選擇用途</option>
-->							

<?php
$sql =  "SELECT id,name FROM household_purpose";
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
										<option value="住宅用">住宅用</option>
										<option value="商業用">商業用</option>
-->										
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-status" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>房子狀態:</label>
								<div class="col-lg-6 col-md-9">
									<select name="household-status" id="household-status" class="form-control">
<!--									
										<option value="" selected>選擇用途</option>
-->									
<?php
$sql =  "SELECT id,name FROM household_status";
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
										<option value="自用">自用</option>
										<option value="出租">出租</option>
-->										
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-num" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>戶號:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-num" id="household-num" placeholder="戶號..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-floor" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>樓層:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-floor" id="household-floor" placeholder="樓層..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-own" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>區權人:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-own" id="household-own" placeholder="區權人..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-name" class="text-right col-lg-4 offset-lg-2 col-md-3 col-form-label">
									<span class="important">*</span>住戶姓名:
								</label>
								<div class="col-lg-4 col-md-6">
									<input type="text" class="form-control" name="household-name" id="household-name" placeholder="住戶姓名..." value="">
								</div>
								<div class="col-lg-2 col-md-3 pl-0 ">
									<button class="btn btn-primary btn-same">同區權人</button>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-props" class="text-right col-lg-6 col-md-3 col-form-label">區權比例:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-props" id="household-props" placeholder="區權比例..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-sqft" class="text-right col-lg-6 col-md-3 col-form-label">坪數:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-sqft" id="household-sqft" placeholder="坪數..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-style" class="text-right col-lg-6 col-md-3 col-form-label">房型:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-style" id="household-style" placeholder="?房?廳" value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-guard-amount" class="text-right col-lg-6 col-md-3 col-form-label">應收管理費金額:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-guard-amount" id="household-guard-amount" placeholder="應收管理費金額..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-park-amount" class="text-right col-lg-6 col-md-3 col-form-label">應收停車費金額:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-park-amount" id="household-park-amount" placeholder="應收停車費金額..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-buy-date" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>購置日期:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control datepicker" name="assets-buy-date" id="assets-buy-date" placeholder="購置日期..." >
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-use-state" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>使用狀態:
								</label>
								<div class="col-lg-6 col-md-9">
									<select class="custom-select" name="assets-use-state">
<!--									
										<option selected>選取狀態</option>
-->										
<?php
$sql =  "SELECT id,name FROM household_used_for";
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
										<option value="自用">自用</option>
										<option value="租賃">租賃</option>
-->										
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-6 offset-md-3 col-md-9 offset-md-3">
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
<script>
$('.btn-same').on('click',function(e){
	var _val=$('#household-own').val()
	$('#household-name').val(_val)
	e.preventDefault()
})
</script>
<?php 
include(Document_root.'/Footer.php');
?>