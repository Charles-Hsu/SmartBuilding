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
    <a class="" href="./space-management.php">空間變更</a>
    <a class="active" href="./management.php">管理辦法</a>
<?php
}
?>    
    <a class="" href="./announcement.php">公告</a>
    <a class="" href="./opinionlist.php">住戶意見</a>
    <a class="" href="./overduelist.php">欠繳費用</a>
</nav>

<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<div id="assets-tab">
			<!--
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/index.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>回首頁</span>
				</div>
			-->				
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8 col-md-12 col-12">
						<form class="assets-create-form" action="" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="management-file" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>管理辦法檔案:</label>
								<div class="col-md-8">
									<select name="management-file" id="management-file" class="form-control">
                                        <option value="" selected>選擇檔案</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button type="submit" class="btn btn-outline-secondary">下載</button>
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