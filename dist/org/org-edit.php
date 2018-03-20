<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 

$staff_no = $_GET['no'];
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

if (count($_POST) > 0) {

	$para = array();
	$para['mobile'] = $_POST['orgstaff-phone'];
	$para['corp'] = $_POST['orgstaff-company'];
	$para['trained_date'] = $_POST['orgstaff-traindate'];
	$para['quit_date'] = $_POST['orgstaff-resigned'];

	$sql = 'UPDATE staff SET mobile = "' . $para['mobile'] . '", corp = "' . $para['corp'] . '", trained_date = "' . $para['trained_date'] . '", quit_date = "' . $para['quit_date'] . '" WHERE no = "' . $staff_no . '"';

	//echo $sql;
	$db->update($sql);
}



$sql = 'SELECT * FROM staff WHERE no = "' . $staff_no . '"';
//echo $sql;



$data = $db->getRows($sql);
//var_dump($data);
$staff = $data[0];
//var_dump($staff);


session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);

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
					<a class="nav-link" href="<?= $urlName ?>/org/#">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">承包商管理</a>
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
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">組織管理團</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/org.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>修改職員資料</span>
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
									姓名:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?=$staff['name'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-num" class="text-right col-md-4 col-form-label">
									員工編號:</label>
								<div class="col-md-8">
								<input type="text" class="form-control" value="<?=$staff['no'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-phone" class="text-right col-md-4 col-form-label">
									手機號碼:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="orgstaff-phone" id="orgstaff-phone" value="<?=$staff['mobile'];?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-id" class="text-right col-md-4 col-form-label">
									身分證字號:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?=$staff['identify'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-company" class="text-right col-md-4 col-form-label">
									所屬物業公司:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="orgstaff-company" id="orgstaff-company" value="<?=$staff['corp'];?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-toworkdate" class="text-right col-md-4 col-form-label">
									到職日:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" value="<?=$staff['on_board_date'];?>" readonly>
								</div>
							</div>
							
							<div class="form-group row">
								<label for="orgstaff-traindate" class="text-right col-md-4 col-form-label">
									在職訓練完成日期:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="orgstaff-traindate" id="orgstaff-traindate" value="<?=$staff['trained_date'];?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-resigned" class="text-right col-md-4 col-form-label">
									離職日:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="orgstaff-resigned" id="orgstaff-resigned" value="<?=$staff['quit_date'];?>">
								</div>
							</div>
					
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-outline-secondary">更新</button>
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