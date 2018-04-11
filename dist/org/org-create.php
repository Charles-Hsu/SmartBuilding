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
					<a class="nav-link active" href="<?= $urlName ?>/org.php">人員</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/household.php">住戶意見</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/works.php">工作日誌</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/mails.php">郵件紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/org.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增社區職員</span>
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
								<label for="orgstaff-name" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>姓名:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="orgstaff-name" id="orgstaff-name">
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-num" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>員工編號:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="orgstaff-num" id="orgstaff-num">
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-phone" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>手機號碼:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="orgstaff-phone" id="orgstaff-phone">
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-id" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>身分證字號:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="orgstaff-id" id="orgstaff-id">
								</div>
							</div>


							<div class="form-group row">
								<label for="orgstaff-id" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>職稱:
								</label>
								<div class="col-md-8">
									<select name="household-area" id="household-area" class="form-control">
<?php
	$sql = 'SELECT * FROM staff_role';
	$data = $db->getRows($sql);
?>								
<?php
foreach($data as $var) {
	//	echo $var['Name'];
	//echo $var['id'];
?>
										<option value="<?=$var['id'];?>"><?=$var['title'];?></option>
<?php
}
?>

									</select>
								</div>
							</div>




							<div class="form-group row">
								<label for="orgstaff-company" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>所屬物業公司(或自聘):
								</label>
								<div class="col-md-8">
									
								<select name="household-area" id="household-area" class="form-control">
<!--								
									<option value="0">自聘</option>
-->									
<?php
	$sql = 'SELECT * FROM contract';
	$data = $db->getRows($sql);
?>								
<?php
foreach($data as $var) {
	//	echo $var['Name'];
	//echo $var['id'];
?>
										<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
<?php
}
?>

									</select>


								</div>
							</div>


							
							<div class="form-group row">
								<label for="orgstaff-toworkdate" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>到職日:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="orgstaff-toworkdate" id="orgstaff-toworkdate">
								</div>
							</div>
<!--							
							<div class="form-group row">
								<label for="orgstaff-traindate" class="text-right col-md-4 col-form-label">
									在職訓練完成日期:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="orgstaff-traindate" id="orgstaff-traindate">
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-resigned" class="text-right col-md-4 col-form-label">
									離職日:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="orgstaff-resigned" id="orgstaff-resigned">
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
	$('.datepicker').val(`${now_year}-${now_month}-${now_date}`)
</script>
<?php 
include(Document_root.'/Footer.php');
?>