<?php session_start(); ?>
<?php
	include('./config.php');
	include('./Header.php');
	if (!$_SESSION['online']) {
		$url = "./login.php";
		header("Location: " . $url);
	}
	$_isAdmin = $_SESSION['admin'];
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/announcement.php">公告</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/opinionlist.php">住戶意見</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/overduelist.php">欠繳費用</a>
                </li>
				<?php
					if ($_isAdmin) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/kpi.php">績效指標</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/space-management.php">空間變更</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/management.php">管理辦法</a>
				</li>
				<?php
					}
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/evaluation.php">品質管理</a>
                </li>
			</ul>
			<div id="assets-tab">
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