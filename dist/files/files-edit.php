<?php 
include('../config.php');
include(Document_root.'/Header.php'); 
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/files.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>編輯文件</span>
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
								<label for="files-name" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>文件名稱:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="files-name" id="files-name" placeholder="文件名稱...">
								</div>
							</div>
							<div class="form-group row">
								<label for="files-upload-label" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>檔案上傳:</label>
								<div class="col-md-9">
                                    <label for="files-upload" class="files-upload">
                                        <input name="files-upload" type="file" id="files-upload" class="form-control files-input" placeholder="點擊選擇欲上傳的檔案">
                                        <span class="files-name-box">
                                            <i class="fas fa-upload"></i>
                                            <span class="files-name"></span>
                                        </span>
                                    </label>
								</div>
							</div>
                            <div class="form-group row">
								<div class="col-md-9 offset-md-3">
                                    <a href="#">smartbuilding.sql</a>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">儲存更新</button>
									<button class="btn assets-btn assets-cancel-btn">取消更新</button>
									<button class="btn assets-btn assets-cancel-btn">刪除該文件</button>
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