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

if (count($_POST) > 0) {
	var_dump($_POST);
	// var_dump($_FILES);

	// echo '_FILES[files-upload][name]' . $_FILES['files-upload']['name'];
	// echo '_FILES[files-upload][tmp_name]' . $_FILES['files-upload']['tmp_name'];
	//echo $_FILES['files-upload']['tmp_name'];

	if(!empty($_FILES['uploaded_file']))
	{
	//   $path = "files/";
		$type = $_POST['file-type'];
		$desc = $_POST['desc'];
		$path = "./" . $type . "/";
		$upload_file = basename( $_FILES['uploaded_file']['name']);
	  	$path = $path .$upload_file;
	  	echo $path;
	  	if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
			echo "The file ".  basename( $_FILES['uploaded_file']['name']). " has been uploaded";
			$sql = "INSERT INTO files (`id`,`type`,`desc`,`path`) VALUES (NULL, $type, '$desc', '$upload_file')";
			echo $sql;
			$db->insert($sql);
			$url = "../files.php";
			// $url = "https://www.stackoverflow.com";
			echo "<script>window.location='$url';</script>";
	  	} else {
			echo "There was an error uploading the file, please try again!";
			$message = "檔案上傳失敗";
			echo $message;
	  	}
	}

}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/files.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增檔案</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>檔案種類:
								</label>
								<div class="col-md-9">
									<select id="innerswim-reply" class="form-control" name="file-type">
										<?php
											$sql = "SELECT * FROM file_type";
											$data = $db->getRows($sql);
											foreach($data as $var) {
										?>
										<option value="<?=$var['id'];?>"><?=$var['type'];?></option>
										<?php
											}
										?>
                                	</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="files-name" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>文件名稱:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="files-name" class="files-name" id="files-name" placeholder="文件名稱...">
								</div>
							</div>

							<div class="form-group row">
								<label for="files-upload-label" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>選擇檔案:</label>
								<div class="col-md-9">
                                    <label for="uploaded_file" class="uploaded_file">
                                        <input name="uploaded_file" type="file" id="uploaded_file" class="form-control files-input">
										<!-- <input type="file" name="uploaded_file" class="uploaded_file">></input> -->
                                        <span class="files-name-box">
                                            <span class="files-name">點擊選擇欲上傳的檔案</span>
                                        </span>
                                    </label>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">上傳</button>
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
<script>
    $('#uploaded_file').on('change',function(){
        var _name=$('#uploaded_file').val().split('\\')[$('#uploaded_file').val().split('\\').length-1];
        $('.files-name').text(_name)
    })
</script>
<?php
include(Document_root.'/Footer.php');
?>