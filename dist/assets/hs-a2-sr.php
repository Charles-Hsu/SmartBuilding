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

//	var_dump($_POST);

	$data = array();

//	$data['building'] = $_POST['household-area'];
	$data['purpose'] = $_POST['household-use'];


//echo "household-use = " . $_POST['household-use'] . "<br>";


	$data['status'] = $_POST['household-status'];
    //$data['addr_no'] = $_POST['household-num'];

    $data['addr_no'] = $_GET['addr_no'];
    $data['floor'] = $_GET['floor'];

//	$data['floor'] = $_POST['household-floor'];
	$data['holder'] = $_POST['household-own'];
	$data['resident'] = $_POST['household-name'];
	//$data['owner_percentage'] = $_POST['household-props'];
//	$data['space'] = $_POST['household-sqft'];
//	$data['house_type'] = $_POST['household-style'];
	$data['due'] = $_POST['household-guard-amount'];
	$data['parking_lot_due'] = $_POST['household-park-amoun'];
	$data['buy_date'] = $_POST['assets-buy-date'];
	$data['used_for'] = $_POST['assets-use-state'];

    $sql = 'UPDATE household SET purpose = ' . $data["purpose"] . ', status = ' . $data['status'] . ', holder = "' . $data['holder'] . '", resident = "' . $data['resident'] . '", due = "' . $data['due'] . '", parking_lot_due = "' . $data['parking_lot_due'] . '", buy_date = "' . $data['buy_date'] . '", used_for = ' . $data['used_for'] . ' WHERE addr_no = "' . $data['addr_no'] . '" AND floor = "' . $data['floor'] . '"';

	//echo $sql;

	if ($db->insert($sql)) {
	//if ($db->insertRow($table, $data)) {
		$message="修改成功";
	}
}

$id = $_GET['id'];
//$addr_no = $_GET['addr_no'];
//$floor = $_GET['floor'];
//$sql = 'SELECT * FROM household WHERE addr_no = "' . $addr_no . '" AND floor ="' . $floor . '"';
$sql = 'SELECT * FROM household WHERE id = ' . $id;
$household = $db->getRow($sql);
//var_dump($household);

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
					<a class="nav-link active" href="/smartbuilding/assets/household.php">產權管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/sellrent.php">租售管理</a>
				</li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/assets/household.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增產權租售</span>
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
									所屬大樓:</label>
								<div class="col-lg-6 col-md-9">
                    				<input type="text" class="form-control" value="<?=$household['building'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-num" class="text-right col-lg-6 col-md-3 col-form-label">
									戶號:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" value="<?=$household['addr_no'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-floor" class="text-right col-lg-6 col-md-3 col-form-label">
									樓層:
								</label>
								<div class="col-lg-6 col-md-9">
                                <input type="text" class="form-control" value="<?=$household['floor'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-own" class="text-right col-lg-6 col-md-3 col-form-label">
									區權人:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-own" id="household-own" value="<?=$household['holder'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-props" class="text-right col-lg-6 col-md-3 col-form-label">區權比例:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" value="<?=$household['owner_percentage']?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-sqft" class="text-right col-lg-6 col-md-3 col-form-label">坪數:</label>
								<div class="col-lg-6 col-md-9">
                                <input type="text" class="form-control" value="<?=$household['space'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-style" class="text-right col-lg-6 col-md-3 col-form-label">房型:</label>
								<div class="col-lg-6 col-md-9">
                                <input type="text" class="form-control" value="<?=$household['house_type'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-guard-amount" class="text-right col-lg-6 col-md-3 col-form-label">帶看費用:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-guard-amount" id="household-guard-amount" value="<?=$household['due'];?>">
								</div>
							</div>




							<div class="form-group row">
								<label for="household-status" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>租/售:</label>
								<div class="col-md-8">
									<select name="household-status" id="household-status" class="form-control">
										<option value="1">出租</option>
										<option value="0">出售</option>
									</select>
								</div>
							</div>



    						<div class="form-group row">
								<div class="col-lg-6 offset-md-3 col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">確定</button>
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