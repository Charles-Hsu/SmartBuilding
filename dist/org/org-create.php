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

							<div id="my-license">
								<div id="my-license-header">專業證照列表選單</div>
								<div class="my-license-type">
									<div class="title">物業管理類</div>
									<div class="license-list d-flex flex-wrap">
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="property-manage_a" class="form-check-input" name="property-manage" value="property-manage_a">
											<label for="property-manage_a" class="mb-0">事務管理人員</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="property-manage_b" class="form-check-input" name="property-manage" value="property-manage_b">
											<label for="property-manage_b" class="mb-0">防火避難設施管理人</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="property-manage_c" class="form-check-input" name="property-manage" value="property-manage_c">
											<label for="property-manage_c" class="mb-0">設備安全管理人員</label>
										</div>
									</div>
								</div>
								<div class="my-license-type">
									<div class="title">機電類</div>
									<div class="license-list d-flex flex-wrap">
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_a" class="form-check-input" name="elect" value="elect_a">
											<label for="elect_a" class="mb-0">電匠</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_b" class="form-check-input" name="elect" value="elect_b">
											<label for="elect_b" class="mb-0">冷凍空調</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_c" class="form-check-input" name="elect" value="elect_c">
											<label for="elect_c" class="mb-0">水匠</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_d" class="form-check-input" name="elect" value="elect_d">
											<label for="elect_d" class="mb-0">工業配線</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_e" class="form-check-input" name="elect" value="elect_e">
											<label for="elect_e" class="mb-0">室內配線</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_f" class="form-check-input" name="elect" value="elect_f">
											<label for="elect_f" class="mb-0">工業電子</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_g" class="form-check-input" name="elect" value="elect_g">
											<label for="elect_g" class="mb-0">鍋爐操作</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_h" class="form-check-input" name="elect" value="elect_h">
											<label for="elect_h" class="mb-0">高壓氣體</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_i" class="form-check-input" name="elect" value="elect_i">
											<label for="elect_i" class="mb-0">壓力容器</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_j" class="form-check-input" name="elect" value="elect_j">
											<label for="elect_j" class="mb-0">消防設備士(師)</label>
										</div>
										<div class="form-check-inline mr-0">
											<input type="checkbox" id="elect_k" class="form-check-input" name="elect" value="elect_k">
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
				licenseArr.push($(this).next('label').text())
			}
		})
		for(var i=0;i<licenseArr.length;i++){
			$('.license-box').append(`<span class="license-name">${licenseArr[i]}</span>`)
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