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

	$staff_id = $_GET['id'];

	if (count($_POST) > 0) {
		// var_dump($_POST);
		$para = array();
		$para['mobile'] = $_POST['orgstaff-phone'];
		$para['corp'] = $_POST['orgstaff-company'];
		$para['trained_date'] = $_POST['orgstaff-traindate'];
		$para['quit_date'] = $_POST['orgstaff-resigned'];
		$para['license'] = $_POST['license'];

		// $sql = 'UPDATE staff SET mobile = "' . $para['mobile'] . '", corp = "' . $para['corp'] . '", trained_date = "' . $para['trained_date'] . '", quit_date = "' . $para['quit_date'] . '", license = "' . $para['license'] . '" WHERE id = "' . $staff_id . '"';
		$sql = 'UPDATE staff SET mobile = "' . $para['mobile'] . '", trained_date = "' . $para['trained_date'] . '", quit_date = "' . $para['quit_date'] . '", license = "' . $para['license'] . '" WHERE id = "' . $staff_id . '"';

		// echo $sql;

		$db->update($sql);
	}

	$sql = "SELECT a.id AS staff_id, a.name AS staff_name, a.mobile, a.no AS staff_no, b.title, c.name AS contract_name FROM staff a, staff_role b, contract c WHERE a.role = b.id AND a.contract_id = c.id" ;

	$staff = $db->getRow($sql);
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

                <!-- <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li> -->
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/org.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>修改職員資料</span>
				</div>
				<?php
					$staff_id = $_GET['id'];
					$sql = "SELECT a.id AS staff_id, a.name AS staff_name, a.mobile, a.no AS staff_no, b.title, c.name AS contract_name FROM staff a, staff_role b, contract c WHERE a.role = b.id AND a.contract_id = c.id" ;

					"SELECT identify, a.id AS `staff_id`, a.name AS `staff_name`, a.mobile, a.no AS staff_no, b.title, c.name AS contract_name FROM staff a, staff_role b, contract c WHERE a.role = b.id AND a.contract_id = c.id and a.id = 3" ;

					$sql = "SELECT a.license, a.quit_date, a.trained_date, a.on_board_date, identify, a.id AS `staff_id`, a.name AS `staff_name`, a.mobile, a.no AS staff_no, b.title, c.name AS corp_name FROM staff a, staff_role b, contract c WHERE a.role = b.id AND a.contract_id = c.id and a.id = " . $staff_id;

					$staff = $db->getRow($sql);
				?>

				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="orgstaff-name" class="text-right col-md-4 col-form-label">
									姓名:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?=$staff['staff_name'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-num" class="text-right col-md-4 col-form-label">
									員工編號:</label>
								<div class="col-md-8">
								<input type="text" class="form-control" value="<?=$staff['staff_no'];?>" readonly>
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
									<input readonly type="text" class="form-control" name="orgstaff-company" id="orgstaff-company" value="<?=$staff['corp_name'];?>">
								</div>
							</div>

							<div class="form-group row">
								<label for="orgstaff-company" class="text-right col-md-4 col-form-label">
									證照:
								</label>
								<?php
									$sql = "SELECT license_id FROM license_of_staff WHERE staff_id='$staff_id'";
									$sql = "SELECT b.name FROM license_of_staff a, license b WHERE staff_id='$staff_id' AND a.license_id = b.id";
									// echo $sql;
									$data = $db->getRows($sql);
									$license_list = "";
									foreach($data AS $var) {
										$license_list .= ($var['name'] . ",");
										// echo $var['name'];
									}
									$len = strlen($license_list);
									if ($len > 0) {
										$license_list = substr($license_list, 0, $len-1);
									}

								?>
								<div class="col-md-8 d-flex align-items-center">
									<div class="license-edit">
										<?php echo $license_list; ?>
									</div>
								</div>
							</div>

							<div class="form-group row">
								<label for="orgstaff-company" class="text-right col-md-4 col-form-label">
									良民證:
								</label>
								<div class="col-md-8 d-flex align-items-center">
									<div class="form-check">
										<input type="checkbox" id="pcc" name="pcc" class="form-check-input" value="用打勾的跳頁顯示數量(良民證)" checked disabled>
										<!-- <select id="innerswim-reply" class="form-control" name="license">
											<?php
												$sql = "SELECT * FROM license_type";
												$data = $db->getRows($sql);

												foreach($data as $var) {
													echo "var[id]=" . $var['id'];
													echo "staff[license]=" . $staff['license'];
													$selected = "";
													if ($var['id'] == $staff['license']) {
														$selected = "selected";
													}
											?>
											<option <?php echo $selected;?> value="<?=$var['id'];?>"><?=$var['type'];?></option>
											<?php
												}
											?>
										</select> -->
										<label class="form-check-label" for="pcc">良明證</label>
									</div>
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
									<?php
										if (strlen($staff['trained_date']) == 0 || $staff['trained_date'] == '0000-00-00') {
											$trained_date = "";
										}
										else {
											$trained_date = $staff['trained_date'];
										}
									?>
									<input type="text" class="form-control datepicker" name="orgstaff-traindate" id="orgstaff-traindate" value="<?=$trained_date;?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-resigned" class="text-right col-md-4 col-form-label">
									離職日:
								</label>
								<div class="col-md-8">
									<?php
										if (strlen($staff['quit_date']) == 0 || $staff['quit_date'] == '0000-00-00') {
											$quit_date = "";
										}
										else {
											$quit_date = $staff['quit_date'];
										}
									?>

									<input type="text" class="form-control datepicker" name="orgstaff-resigned" id="orgstaff-resigned" value="<?php echo $quit_date;?>">
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