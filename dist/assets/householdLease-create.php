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
						<form class="householdLease-form" action="" method="POST">
							<div class="form-group row">
								<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
								<div class="col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
							<div class="form-group row">
								<label for="intermediary-name" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>仲介名稱:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="intermediary-name" id="intermediary-name" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="doc-upload" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>委託書上傳:</label>
								<div class="col-md-8">
                                    <label for="doc-upload" class="files-upload">
                                        <input name="doc-upload" type="file" id="doc-upload" class="form-control files-input" placeholder="點擊選擇欲上傳的檔案">
                                        <span class="files-name-box">
                                            <span class="files-name">點擊選擇欲上傳的檔案</span>
                                        </span>
                                    </label>
								</div>
							</div>
							<div class="form-group row">
								<label for="leaseDoc-upload" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>租賃文件上傳:</label>
								<div class="col-md-8">
                                    <label for="leaseDoc-upload" class="files-upload">
                                        <input name="leaseDoc-upload" type="file" id="leaseDoc-upload" class="form-control files-input" placeholder="點擊選擇欲上傳的檔案">
                                        <span class="files-name-box">
                                            <span class="files-name">點擊選擇欲上傳的檔案</span>
                                        </span>
                                    </label>
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
	$('.files-input').on('change',function(){
        var _name=$('.files-input').val().split('\\')[$('.files-input').val().split('\\').length-1];
        $(this).next().find('.files-name').text(_name)
    })
	$('.householdLease-form').on('submit',function(){

	})
</script>
<?php 
include(Document_root.'/Footer.php');
?>