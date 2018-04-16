<?php session_start(); ?>
<?php 
	include('./config.php');
	include('./Header.php'); 
	$_isAdmin = $_SESSION['admin'];
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

?>
<!-- 內容切換區 -->
<nav class="index-nav my-3">
<?php
	if ($_isAdmin) {
?>
    <a class="" href="./kpi.php">績效指標</a>
    <a class="active" href="./space-management.php">空間變更</a>
    <a class="" href="./management.php">管理辦法</a>
<?php
	}
?>    
    <a class="" href="./announcement.php">公告</a>
    <a class="" href="./opinionlist.php">住戶意見</a>
    <a class="" href="./overduelist.php">欠繳清單</a>
    <a class="" href="./resolutions.php">決議事項</a>
</nav>
<?php 
	if (count($_POST) > 0) {
		var_dump($_POST);

		echo '_FILES[files-upload][name]' . $_FILES['files-upload']['name'];
		echo '_FILES[files-upload][tmp_name]' . $_FILES['files-upload']['tmp_name'];
		//echo $_FILES['files-upload']['tmp_name'];

		$handle = fopen($_FILES(['files-upload']['tmp_name']), 'r');

		echo $handle;
		echo "after handle";
	}
?>
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<div id="assets-tab">
<!--			
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/index.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>空間變更申請</span>
				</div>
-->				
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="proposal-upload-label" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>提案:</label>
								<div class="col-md-9">
                                    <label for="proposal-upload" class="files-upload">
                                        <input name="proposal-upload" type="file" id="proposal-upload" class="form-control files-input" placeholder="點擊選擇欲提案的檔案">
                                        <span class="files-name-box">
                                            <span class="files-name">點擊選擇欲提案的檔案</span>
                                        </span>
                                    </label>
								</div>
                            </div>
                            <div class="form-group row">
								<label for="method-upload-label" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>辦法:</label>
								<div class="col-md-9">
                                    <label for="method-upload" class="files-upload">
                                        <input name="method-upload" type="file" id="method-upload" class="form-control files-input" placeholder="點擊選擇欲辦法的檔案">
                                        <span class="files-name-box">
                                            <span class="files-name">點擊選擇欲辦法的檔案</span>
                                        </span>
                                    </label>
								</div>
                            </div>
                            <div class="form-group row">
								<label for="announce-upload-label" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>公告:</label>
								<div class="col-md-9">
                                    <label for="announce-upload" class="files-upload">
                                        <input name="announce-upload" type="file" id="announce-upload" class="form-control files-input" placeholder="點擊選擇欲公告的檔案">
                                        <span class="files-name-box">
                                            <span class="files-name">點擊選擇欲公告的檔案</span>
                                        </span>
                                    </label>
								</div>
                            </div>
                            
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button type="submit" class="btn btn-outline-secondary">確認</button>
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
    $('#files-upload').on('change',function(){
        var _name=$('#files-upload').val().split('\\')[$('#files-upload').val().split('\\').length-1];
        $('.files-name').text(_name)
    })
</script>
<?php 
include(Document_root.'/Footer.php');
?>