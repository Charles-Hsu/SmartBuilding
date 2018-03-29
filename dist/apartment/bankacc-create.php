<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 

$table = 'bank_acc';
$sql = 'SELECT * FROM ' . $table . ' ORDER BY id DESC LIMIT 1';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
//echo $sql;
$data = $db->getRows($sql);
$data = $data[0];
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);

//echo $data['account_purpose'];

if (count($_POST) > 0) {
	var_dump($_POST);

	$data = array();
	$data['account_purpose'] = $_POST['bankacc-use'];
	$data['account_type'] = $_POST['bankacc-type'];
	$data['bank_name'] = $_POST['bank-name'];
	$data['account_number'] = $_POST['bankacc-account'];
	$data['account_name'] = $_POST['bankacc-name'];
	$data['account_balance'] = $_POST['bankacc-balance'];
	$data['comment'] = $_POST['bankacc-note'];

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
	$values = substr($values, 0, strlen($values)-1);

	echo $fields;
	echo $values;

	$sql = 'INSERT INTO ' . $table . ' (' . $fields . ') ' . ' VALUES (' . $values . ')';
				
	echo $sql;
				
	if ($db->insert($sql)) {
				//if ($db->insertRow($table, $data)) {
		$message="新增成功";
	}

}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment.php">基本資料</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/building.php">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/public-util.php">公共設施</a>
                </li>
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/apartment/bank-acc.php">銀行專戶</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/apartment/bank-acc.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增銀行專戶</span>
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
									<span class="important">*</span>專戶用途:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-use" id="bankacc-use" placeholder="<?=$data['account_purpose'];?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="bankacc-type" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>專戶類型:</label>
								<div class="col-md-8">








									
								<select name="bankacc-type" id=""bankacc-type" class="form-control">
<!--								
									<option value="0">自聘</option>
-->									
<?php
	$sql = 'SELECT * FROM bank_acc_type';
	$data = $db->getRows($sql);
?>								
<?php
foreach($data as $var) {
	//	echo $var['Name'];
	//echo $var['id'];

	$selected = "";
	if ($var['id'] == 2) {
		$selected = "selected";
	}


?>
<!--
										<option value="2" selected>定期存款</option>
-->										
										<option value="<?=$var['id'];?>" <?=$selected;?>><?=$var['type'];?></option>
<?php
}
?>

									</select>

					
								
								
								
								
								
								
								</div>
							</div>

<!--
							<div class="form-group row">
								<label for="bankacc-code" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>銀行代碼:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-code" id="bankacc-code" placeholder="<?=$data['bank_no'];?>">
								</div>
							</div>
-->
							<div class="form-group row">
								<label for="bank-name" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>銀行名稱:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bank-name" id="bank-account" placeholder="<?=$data['bank_name'];?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="bankacc-account" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>銀行帳號:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-account" id="bankacc-account" placeholder="<?=$data['account_number'];?>">
								</div>
							</div>



							<div class="form-group row">
								<label for="bankacct-name" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>帳戶名稱:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-name" id="bankacc-name" placeholder="<?=$data['account_name'];?>" >
								</div>
							</div>




							<div class="form-group row">
								<label for="bankacc-balance" class="text-right col-md-4 col-form-label">
									銀行餘額:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-balance" id="bankacc-balance" placeholder="<?=$data['account_balance'];?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="bankacc-note" class="text-right col-md-4 col-form-label">
									備註:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="bankacc-note" id="bankacc-note" placeholder="<?=$data['comment'];?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-outline-secondary">新增</button>
									<button class="btn btn-outline-secondary">取消</button>
								</div>
							</div>


					<?php //$message = "TEST"; ?>
                    <?php if($message!="") { ?>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <div class="alert alert-danger text-center" role="alert"><?php echo $message; ?></div>
                        </div>
                    </div>
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