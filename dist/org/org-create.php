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

	if (COUNT($_POST)) {
		var_dump($_POST);
		// echo $_POST['property-manage_a'];
		// echo $_POST['property-manage_b'];

		// array(8) { ["orgstaff-name"]=> string(9) "許家齊" ["orgstaff-num"]=> string(4) "0006" ["orgstaff-phone"]=> string(11) "0968-123311" ["orgstaff-id"]=> string(10) "Y120129015" ["orgstaff-role"]=> string(1) "1" ["orgstaff-toworkdate"]=> string(10) "2018-04-27" ["pcc"]=> string(2) "on" ["license"]=> array(6) { [0]=> string(1) "1" [1]=> string(1) "4" [2]=> string(1) "7" [3]=> string(2) "10" [4]=> string(2) "13" [5]=> string(2) "15" } }

		$staff_name = $_POST["orgstaff-name"];
		$staff_no = $_POST["orgstaff-num"];
		$staff_phone = $_POST["orgstaff-phone"];
		$staff_id = $_POST["orgstaff-id"];
		$staff_role = $_POST["orgstaff-role"];
		$staff_on_board = $_POST["orgstaff-toworkdate"];
		$staff_good_person = $_POST["pcc"];
		$contract_id = $_POST["orgstaff-contract-id"];
		$licence_num = count($_POST["license"]);

		// $sql = "INSERT INTO staff () VALUES ()";
		$sql = "INSERT INTO staff (`id`, `name`, `no`, `mobile`, `identify`, `contract_id`, `role`, `on_board_date`, `trained_date`, `quit_date`, `license`) VALUES	(NULL, '$staff_name', '$staff_no', '$staff_phone', '$staff_id', '$contract_id', '$staff_role', '$staff_on_board', NULL, NULL, '$licence_num')";
		echo $sql;
		$db->insert($sql);
		$sql = "SELECT MAX(id) AS id FROM staff";
		$id = $db->getValue($sql);
		echo $id;
		foreach ($_POST["license"] AS $var) {
			// echo $var;
			$sql = "INSERT INTO license_of_staff (`id`, `license_id`, `staff_id`) VALUES (NULL, '$var', '$id')";
			echo $sql;
			$db->insert($sql);
		}

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
									<?php
										$sql = "SELECT LPAD(MAX(no)+1,4,0) FROM `staff`";
										$staff_no = $db->getValue($sql);
									?>
									<span class="important">*</span>員工編號:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="orgstaff-num" id="orgstaff-num" value="<?php echo $staff_no;?>" readonly>
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
									<select name="orgstaff-role" id="orgstaff-role" class="form-control">
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
									<select name="orgstaff-contract-id" id="orgstaff-contract-id" class="form-control">
										<?php
											$sql = 'SELECT * FROM contract';
											$data = $db->getRows($sql);
										?>
										<?php
											foreach($data as $var) {
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


							<div class="form-group row">
								<label for="orgstaff-toworkdate" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>專業證照:
								</label>
								<div class="col-md-8">
									<div class="license-box">
										<span></span>
									</div>
								</div>
							</div>

							<div class="form-group row">
								<label for="orgstaff-toworkdate" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>良民證:
								</label>
								<div class="col-md-8 d-flex align-items-center">
									<div class="form-check">
										<input type="checkbox" class="form-check-input" name="pcc" id="pcc">
										<label for="pcc" class="form-check-label">良民證</label>
									</div>
								</div>
							</div>


							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-outline-secondary">新增</button>
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
											<input type="checkbox" id="property-manage_a" class="form-check-input" name="license[]" value="1">
											<label for="property-manage_a" class="mb-0">事務管理人員</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="property-manage_b" class="form-check-input" name="license[]" value="2">
											<label for="property-manage_b" class="mb-0">防火避難設施管理人</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="property-manage_c" class="form-check-input" name="license[]" value="3">
											<label for="property-manage_c" class="mb-0">設備安全管理人員</label>
										</div>
									</div>
								</div>
								<div class="my-license-type">
									<div class="title">機電類</div>
									<div class="license-list d-flex flex-wrap">
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_a" class="form-check-input" name="license[]" value="4">
											<label for="elect_a" class="mb-0">電匠</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_b" class="form-check-input" name="license[]" value="5">
											<label for="elect_b" class="mb-0">冷凍空調</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_c" class="form-check-input" name="license[]" value="6">
											<label for="elect_c" class="mb-0">水匠</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_d" class="form-check-input" name="license[]" value="7">
											<label for="elect_d" class="mb-0">工業配線</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_e" class="form-check-input" name="license[]" value="8">
											<label for="elect_e" class="mb-0">室內配線</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_f" class="form-check-input" name="license[]" value="9">
											<label for="elect_f" class="mb-0">工業電子</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_g" class="form-check-input" name="license[]" value="10">
											<label for="elect_g" class="mb-0">鍋爐操作</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_h" class="form-check-input" name="license[]" value="11">
											<label for="elect_h" class="mb-0">高壓氣體</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_i" class="form-check-input" name="license[]" value="12">
											<label for="elect_i" class="mb-0">壓力容器</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_j" class="form-check-input" name="license[]" value="13">
											<label for="elect_j" class="mb-0">消防設備士(師)</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_k" class="form-check-input" name="license[]" value="14">
											<label for="elect_k" class="mb-0">汙廢水操作人員</label>
										</div>
									</div>
								</div>

								<div class="my-license-type">
									<div class="title">環保類</div>
									<div class="license-list d-flex flex-wrap">
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="environ_a" class="form-check-input" name="license[]" value="15">
											<label for="environ_a" class="mb-0">病媒防治</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="environ_b" class="form-check-input" name="license[]" value="16">
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
	$('.datepicker').val(`${now_year}-${now_month}-${now_date}`);


	dragElement(document.getElementById(("my-license")));
	var licenseArr=[];
	$('.license-btn').on('click',function(e){
		e.preventDefault();
		licenseArr=[];
		$('.license-box').html('')
		$('#my-license').find('input:checkbox').each(function(index,item){
			if($(this).prop('checked') == true){
				licenseArr.push({value:$(this).val(),name:$(this).next('label').text()})
			}
		})
		for(var i=0;i<licenseArr.length;i++){
			$('.license-box').append(`<span class="license-name" data-title="${licenseArr[i].value}">${licenseArr[i].name}</span>`)
		}
		$('#my-license').hide();
	})

	$('.license-box').on('click',function(e){
		$('#my-license').show();
	})
</script>
<?php
include(Document_root.'/Footer.php');
?>