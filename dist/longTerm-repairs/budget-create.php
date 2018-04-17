<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 


$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

if (count($_POST) > 0) {
	var_dump($_POST);
	$name = $_POST['budget-title'];
	$amount = $_POST['budget-amount'];
	$acc_id = $_POST['acc_id'];
	$planning_date = $_POST['planning_date'];
	$budget_years = $_POST['budget_years'];
// INSERT INTO `budget` (`id`, `name`, `planning_dt`, `amount`, `bank_acc_no`, `budget_years`) VALUES (NULL, 'A大樓電梯更換', '2018-03-29', '200000', '15', '5');
	$sql = "INSERT INTO `budget` (`id`, `name`, `planning_dt`, `amount`, `bank_acc_no`, `budget_years`) VALUES (NULL, '" . $name . "', '" . $planning_date .  "', '"  . $amount . "', '" . $acc_id . "', '" . $budget_years . "')";
	echo $sql;

	if ($db->insert($sql)) {
		//if ($db->insertRow($table, $data)) {
		$message="新增成功";
	}

}

$sql = 'SELECT a.id,a.account_name,a.bank_name,a.account_number,a.account_purpose,a.account_balance,b.type FROM bank_acc a, bank_acc_type b WHERE a.account_type = b.id';


$data = $db->getRows($sql);

session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);
/*
if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}
*/
?>
<script>
	var bank_data=<?php echo json_encode($data) ?>;
	// var _var = $('#acc_id').val();
/*	
	bank_data.forEach(function(item,index) {
		if (item.id == _val) {
			$('#bank_name').val(item.bank_name);
			$('#account_purpose').val(item.account_purpose);
			var str = new Intl.NumberFormat('en', { maximumSignificantDigits: 3 }).format(item.account_balance);
			$('#account_balance').val(item.str);
		}
	})
*/	
	$(function(){
		var _val = $('#acc_id').val();
		bank_data.forEach(function(item,index) {
			if (item.id == _val) {
				$('#bank_name').val(item.bank_name);
				$('#account_purpose').val(item.account_purpose);
				var str = new Intl.NumberFormat('en', { maximumSignificantDigits: 3 }).format(item.account_balance);
				$('#account_balance').val(str);
			}
		})
		$('#acc_id').on('change',function(){
			var _val=$(this).val();
			console.log(_val)
			bank_data.forEach(function(item,index){
				if(item.id == _val){
					$('#bank_name').val(item.bank_name);
					$('#account_purpose').val(item.account_purpose);
					var str = new Intl.NumberFormat('en', { maximumSignificantDigits: 3 }).format(item.account_balance);
					$('#account_balance').val(str);
				}
			})
			if(_val == ''){
				$('#bank_name').val('#bank_name')
				$('#account_purpose').val('#account_purpose')
				$('#account_balance').val('#account_balance')
			}
		});
/*		
		$('#acc_id').on('change',function(){
			var _val=$(this).val();
			console.log(_val)
			bank_data.forEach(function(item,index){
				if(item.id == _val){
					$('#bank_name').val(item.bank_name);
					$('#account_purpose').val(item.account_purpose);
					var str = new Intl.NumberFormat('en', { maximumSignificantDigits: 3 }).format(item.account_balance);
					$('#account_balance').val(str);
				}
			})
			if(_val == ''){
				$('#bank_name').val('')
				$('#account_purpose').val('')
				$('#account_balance').val('')
			}
		});		
*/		
	})
</script>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/longTerm-repairs/budget.php">年度預算</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/longTerm-repairs/budget-planning.php">財務籌措</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/longTerm-repairs/bank-acc.php">銀行專戶</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/longTerm-repairs/budget.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>預算編列</span>
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
								<label for="budget-title" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>預算名稱:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="budget-title" id="budget-title" placeholder="預算名稱...">
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
								<label for="budget-amount" class="text-right col-md-4 col-form-label">
								<span class="important">*</span>預算金額:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="budget-amount" id="budget-amount" placeholder="預算金額...">
								</div>
							</div>
							<div class="form-group row">
								<label for="acc_id" class="text-right col-md-4 col-form-label">
								<span class="important">*</span>預算帳戶:
								</label>
								<div class="col-md-8">
									<select name="acc_id" id="acc_id" class="form-control">
<!--
										<option value="" selected>選擇帳戶</option>
-->
<?php 
foreach($data as $value) {
?>
										<option value="<?= $value['id'] ?>"><?=$value['account_name'];?></option>
<?php 
} 
?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="bank_name" class="text-right col-md-4 col-form-label">
									銀行:
								</label>
								<div class="col-md-8">
									<input type="text" id="bank_name" class="form-control" name="bank_name" value="" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="account_purpose" class="text-right col-md-4 col-form-label">
									帳戶用途:
								</label>
								<div class="col-md-8">
									<input type="text" id="account_purpose" class="form-control" name="account_purpose" value="" readonly>
								</div>
							</div>
							<div class="form-group row">
							<label for="account_balance" class="text-right col-md-4 col-form-label">
									帳戶餘額:
								</label>
								<div class="col-md-8">
									<input type="text" id="account_balance" class="form-control" name="account_balance" value="" readonly>
								</div>
							</div>
<!--
							<div class="form-group row">
								<label for="planning_date" class="text-right col-md-4 col-form-label">
									編列日期:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="planning_date" id="planning_date">
								</div>
							</div>
-->
							<div class="form-group row">
								<label for="planning_date" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>編列日期:</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker datepicker1" name="planning_date">
								</div>
							</div>								
							


							<div class="form-group row">
								<label for="budget_years" class="text-right col-md-4 col-form-label">
								<span class="important">*</span>編列年限:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="budget_years" id="budget_years" value="5">
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
<script>

	var now_date=new Date();
	var now_year=now_date.getFullYear();
	var now_month=now_date.getMonth()+1;
	var now_date=now_date.getDate();
	if(now_month<10){
		now_month='0'+now_month
	}
	if(now_date<10){
		now_date='0'+now_date
	}
	$('.datepicker1').val(`${now_year}-${now_month}-${now_date}`)

</script>
<?php 
include(Document_root.'/Footer.php');
?>