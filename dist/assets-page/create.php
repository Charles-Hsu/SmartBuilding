<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SmartBuilding</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link href="../css/fontawesome.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.standalone.min.css">
	<link rel="stylesheet" href="../css/index.css">
	<script src="../js/lib/jquery-3.1.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.zh-TW.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>

<?php
	require '../DBAccess.class.php';
	require '../config.admin.php';
	//$sql = 'SELECT * FROM assets';
	//$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
	//$data = $db->getRows($sql);
//	var_dump($data);
?>

<body>
	<div id="app" class="main-wrapper">
		<div class="d-flex">
			<div class="sidemenu" :class="{slideToggleActive}">
				<div class="sidemenu-wrapper">
					<div class="sidemenu-title my-4">
						<i class="fab fa-optin-monster"></i>
						<span><?=$conf['sysname']?></span>
					</div>
					<ul class="sidemenu-nav">
						<li v-for="(sidemenu,index) in sidemenuList" v-cloak>
							<a :href="sidemenu.link" :class="{active:sidemenu.active}" class="d-flex sidemenu-link" :title="sidemenu.name">
								<i :class="sidemenu.icon"></i>
								<span>{{sidemenu.name}}</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="content">
				<div class="content-wrapper">
					<div class="content-header">
						<i class="slide-toggle-btn fas fa-outdent" @click="slideToggle"></i>
					</div>
					<div class="content-main-wrapper p-3">
						<div class="content-main container-fluid">
							<!-- 內容切換區 -->
							<div class="row">
								<div class="col-12 p-4">
									<div class="asset-manage-wrapper">
										<ul class="nav nav-pills mb-3">
											<li class="nav-item">
												<a class="nav-link active" href="../assets.php">資產管理</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="../household.html">住戶管理</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="../publicfacilities.html">公共設施預約</a>
											</li>
										</ul>
										<div id="assets-tab">
											<div class="assets-create-title mb-3">
												<a href="../assets.html" class="assets-create-icon fas fa-chevron-left"></a>
												<span>新增資產</span>
											</div>
											<div class="row justify-content-lg-start justify-content-center">
												<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
													<form class="assets-create-form" action="" method="POST">
														<div class="form-group row">
															<label for="community" class="text-right col-md-3 col-form-label">所屬社區:</label>
															<div class="col-md-9 d-flex align-items-center">
																<span>XXXXXX</span>
															</div>
														</div>
														<div class="form-group row">
															<label for="assets-no" class="text-right col-md-3 col-form-label">
																<span class="important">*</span>資產編號:</label>
															<div class="col-md-9">
																<input type="text" class="form-control" name="assets-no" id="assets-no" placeholder="資產編號...">
															</div>
														</div>
														<div class="form-group row">
															<label for="assets-name" class="text-right col-md-3 col-form-label">
																<span class="important">*</span>資產名稱:</label>
															<div class="col-md-9">
																<input type="text" class="form-control" name="assets-name" id="assets-name" placeholder="資產名稱...">
															</div>
														</div>
														<div class="form-group row">
															<label for="assets-sort" class="text-right col-md-3 col-form-label">分類:</label>
															<div class="col-md-9">
																<input type="text" class="form-control" name="assets-sort" id="assets-sort" placeholder="分類...">
															</div>
														</div>
														<div class="form-group row">
															<label for="assets-price" class="text-right col-md-3 col-form-label">價格:</label>
															<div class="col-md-9">
																<input type="text" class="form-control" name="assets-price" id="assets-price" placeholder="價格..." value="0">
															</div>
														</div>
														<div class="form-group row">
															<label for="assets-amount" class="text-right col-md-3 col-form-label">數量:</label>
															<div class="col-md-9">
																<input type="text" class="form-control" name="assets-amount" id="assets-amount" placeholder="數量..." value="0">
															</div>
														</div>
														<div class="form-group row">
															<label for="assets-man" class="text-right col-md-3 col-form-label">購置人:</label>
															<div class="col-md-9">
																<input type="text" class="form-control" name="assets-man" id="assets-man" placeholder="購置人...">
															</div>
														</div>
														<div class="form-group row">
															<label for="assets-buy-date" class="text-right col-md-3 col-form-label">
																<span class="important">*</span>購置日期:
															</label>
															<div class="col-md-9">
																<input type="text" class="form-control datepicker" name="assets-buy-date" id="assets-buy-date" placeholder="購置日期..." >
															</div>
														</div>
														<div class="form-group row">
															<label for="assets-use-state" class="text-right col-md-3 col-form-label">
																<span class="important">*</span>使用狀態:
															</label>
															<div class="col-md-9">
																<select class="custom-select">
																	<option selected>選取狀態</option>
																	<option value="One">One</option>
																	<option value="Two">Two</option>
																	<option value="Three">Three</option>
																</select>
															</div>
														</div>
														<div class="form-group row">
															<div class="col-md-9 offset-md-3">
																<button class="btn assets-btn assets-add-btn">新增</button>
																<button class="btn assets-btn assets-cancel-btn">取消</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../js/app.js"></script>
</body>

</html>