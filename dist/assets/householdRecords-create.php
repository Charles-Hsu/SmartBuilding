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
					<a class="nav-link" href="<?= $urlName ?>/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/assets/household.php">物件管理</a>
				</li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/assets/household-create.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>回物件管理</span>
				</div>
				<div class="row">
					<div class="col-xl-6 col-lg-8 col-12">
						<form class="householdRecords-form" action="" method="POST">
							<div class="form-group row">
								<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
								<div class="col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
							<div class="form-group row">
								<label for="records-type" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>費用類別:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="records-type" id="records-type" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="records-date" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>繳交日期:</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="records-date" id="records-date" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="receivables" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>應收金額:</label>
								<div class="col-md-8">
									<input type="number" class="form-control" name="receivables" id="receivables" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="received" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>實收金額:</label>
								<div class="col-md-8">
									<input type="number" class="form-control" name="received" id="received" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button type="submit" class="btn btn-outline-secondary">新增</button>
									<button type="reset" class="btn btn-outline-secondary">取消</button>
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
	$('.householdRecords-form').on('submit',function(e){
		if($('#records-type').val().length <= 0){
			e.preventDefault();
			alert('請輸入費用類別')
			return;
		}
		if($('#records-date').val().length <= 0){
			e.preventDefault();
			alert('請輸入繳交日期')
			return;
		}
		if($('#receivables').val().length <= 0){
			e.preventDefault();
			alert('請輸入應收金額')
			return;
		}
		if($('#received').val().length <= 0){
			e.preventDefault();
			alert('請輸入實收金額')
			return;
		}
	})
</script>
<?php 
include(Document_root.'/Footer.php');
?>