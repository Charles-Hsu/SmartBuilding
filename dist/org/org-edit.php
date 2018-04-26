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
								<label for="orgstaff-toworkdate" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>專業證照:
								</label>
								<div class="col-md-8">
									<div class="license-box">
										<span class="license-name" data-title="elect_g">鍋爐操作</span>
										<span class="license-name" data-title="elect_h">高壓氣體</span>
										<span class="license-name" data-title="elect_j">消防設備士(師)</span>
										<span class="license-name" data-title="environ_a">病媒防治</span>
										<span class="license-name" data-title="environ_b">水池水塔清洗</span>
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


							<!-- 證照列表 -->
							<div id="my-license">
								<div id="my-license-header">專業證照列表選單</div>
								<div class="my-license-type">
									<div class="title">物業管理類</div>
									<div class="license-list d-flex flex-wrap">
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="property-manage_a" class="form-check-input" name="property-manage[]" value="property-manage_a">
											<label for="property-manage_a" class="mb-0">事務管理人員</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="property-manage_b" class="form-check-input" name="property-manage[]" value="property-manage_b">
											<label for="property-manage_b" class="mb-0">防火避難設施管理人</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="property-manage_c" class="form-check-input" name="property-manage[]" value="property-manage_c">
											<label for="property-manage_c" class="mb-0">設備安全管理人員</label>
										</div>
									</div>
								</div>
								<div class="my-license-type">
									<div class="title">機電類</div>
									<div class="license-list d-flex flex-wrap">
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_a" class="form-check-input" name="elect[]" value="elect_a">
											<label for="elect_a" class="mb-0">電匠</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_b" class="form-check-input" name="elect[]" value="elect_b">
											<label for="elect_b" class="mb-0">冷凍空調</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_c" class="form-check-input" name="elect[]" value="elect_c">
											<label for="elect_c" class="mb-0">水匠</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_d" class="form-check-input" name="elect[]" value="elect_d">
											<label for="elect_d" class="mb-0">工業配線</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_e" class="form-check-input" name="elect[]" value="elect_e">
											<label for="elect_e" class="mb-0">室內配線</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_f" class="form-check-input" name="elect[]" value="elect_f">
											<label for="elect_f" class="mb-0">工業電子</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_g" class="form-check-input" name="elect[]" value="elect_g">
											<label for="elect_g" class="mb-0">鍋爐操作</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_h" class="form-check-input" name="elect[]" value="elect_h">
											<label for="elect_h" class="mb-0">高壓氣體</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_i" class="form-check-input" name="elect[]" value="elect_i">
											<label for="elect_i" class="mb-0">壓力容器</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_j" class="form-check-input" name="elect[]" value="elect_j">
											<label for="elect_j" class="mb-0">消防設備士(師)</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_k" class="form-check-input" name="elect[]" value="elect_k">
											<label for="elect_k" class="mb-0">汙廢水操作人員</label>
										</div>
									</div>
								</div>

								<div class="my-license-type">
									<div class="title">環保類</div>
									<div class="license-list d-flex flex-wrap">
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="environ_a" class="form-check-input" name="environ" value="environ_a">
											<label for="environ_a" class="mb-0">病媒防治</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="environ_b" class="form-check-input" name="environ" value="environ_b">
											<label for="environ_b" class="mb-0">水池水塔清洗</label>
										</div>
									</div>
								</div>
								<div class="btn-bar py-2">
									<button class="license-btn btn btn-secondary px-5 py-1">確定</button>
								</div>
							</div>
							<!-- 證照取消 -->

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
dragElement(document.getElementById(("my-license")));
var licenseArr=[];
var licenseBox=[];
$('.license-btn').on('click',function(e){
	e.preventDefault();
	licenseArr=[];
	$('.license-box').html('')
	$('#my-license').find('input:checkbox').each(function(index,item){
		if($(this).prop('checked') == true){
			licenseArr.push($(this).next('label').text())
		}
	})
	for(var i=0;i<licenseArr.length;i++){
		$('.license-box').append(`<span class="license-name">${licenseArr[i]}</span>`)
	}
	$('#my-license').hide();
})

$('.license-box').on('click',function(e){
	$(this).find('span').each(function(index,item){
		licenseBox.push($(this).attr('data-title'))
	})
	for(var i=0;i<licenseBox.length;i++){
		$('#my-license').find('input:checkbox').each(function(index,item){
			if($(this).val() == licenseBox[i]){
				$(this).prop('checked',true)
			}
	})
	}
	$('#my-license').find('input:checkbox').each(function(index,item){
		if($(this).prop('checked') == true){
			licenseArr.push($(this).next('label').text())
		}
	})
	$('#my-license').show();
})
</script>
<?php
include(Document_root.'/Footer.php');
?>