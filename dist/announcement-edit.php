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

<?php

$post_id = $_GET['id'];
$sql = "SELECT date,content FROM post WHERE id = $post_id";
$data = $db->getRow($sql);
// var_dump($data);


if (count($_POST) > 0) {
	var_dump($_POST);
	var_dump($_FILES);
	// echo '<div>_FILES[uploaded_file][name]' . $_FILES['uploaded_file']['name'] . '</div>';
	// echo '<div>_FILES[uploaded_file][tmp_name]' . $_FILES['uploaded_file']['tmp_name'] . '</div>';
	$post_date = $_POST['post-date'];
	echo 'post_date = ' .post_date;
	$filename = basename( $_FILES['uploaded_file']['name']);
	echo 'strlen(filename) = ' . strlen($filename);
	if(!empty($_FILES['uploaded_file'])) {
		echo "not empty";
	}
	if(strlen($filename) > 0) {
		echo " > 0";
	}
	if(!empty($_FILES['uploaded_file']) && strlen($filename) > 0)
	{
		echo "not empty";
		$desc = $_POST['post-content'];
		echo 'desc = ' . $desc;
		$type = 9;
		$path = "./files/9/"; // 公告附件的檔案目錄為 /files/9, 可由資料庫 file_type 看所有其他的類別
		$upload_file = basename( $_FILES['uploaded_file']['name']);
		$path .= $upload_file;
		echo 'path = ' . $path;
		$tmp_file = $_FILES['uploaded_file']['tmp_name'];
		echo "\$tmp_file = $tmp_file";

	  	if(move_uploaded_file($tmp_file, $path)) {
			// echo "The file ".  basename( $_FILES['uploaded_file']['name']). " has been uploaded";
			$sql = "INSERT INTO files (`id`,`dt`,`type`,`desc`,`path`) VALUES (NULL, '$post_date', '$type', '$desc', '$upload_file')";
			echo $sql;
			$db->insert($sql);
			// $url = "../files.php";
			// $url = "https://www.stackoverflow.com";
			// echo "<script>window.location='$url';</script>";
	  	} else {
			// echo "<div>The file ".  basename( $_FILES['uploaded_file']['name']). " uploaded fail</div>";
			// echo "<div>There was an error uploading the file, please try again!</div>";
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
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/announcement.php">公告</a>
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
					<a class="nav-link" href="<?= $urlName ?>/space-management.php">空間變更</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/regulation.php">管理辦法</a>
				</li>
				<?php
					}
				?>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/evaluation.php">品質管理</a>
                </li>
			</ul>
			<?php
				if (count($_POST) > 0) {
					$date = $_POST['post-date'];
					$content = $_POST['post-content'];
					$post_by = '管委會';
					$sql = "INSERT INTO post (`id`, `date`, `post_by`, `content`) VALUES (NULL, '$date', '$post_by', '$content')";
					if ($db->insert($sql)) {
						$message="新增成功";
						$url = "./announcement.php";
						// $url = "http://www.stackoverflow.com";
						// echo "<script>window.location.href = '" . $url . "'</script>";
					}
				}
			?>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="./announcement.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>編輯公告</span> <!--回上一頁'資產管理'-->
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="post-create-form" id="post-create-form" action="" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="post-date" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>公告日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="post-date" id="post-date" value="<?php echo $data['date'];?>" readonly>
								</div>
							</div>
                            <div class="form-group row">
								<label for="assets-no" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>公告標題:</label>
								<div class="col-md-9">
                                    <input type="text" name="post-content"  value="<?php echo $data['content'];?>" readonly>
                                </div>
							</div>


                            <!-- <div class="form-group row">
								<label for="assets-no" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>上傳檔案:</label>
								<div class="col-md-9">
                                    <textarea rows="3" cols="48" name="post-content" form="post-create-form" placeholder="限 PDF 或圖片檔..."></textarea>
                                </div>
							</div> -->


							<div class="form-group row">
								<label for="files-upload-label" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>附加檔案:</label>
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
									<button class="btn assets-btn assets-add-btn">確認</button>
									<button class="btn assets-btn assets-delete-btn">刪除</button>
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
    // $('#uploaded_file').on('change',function(){
    //     var _name=$('#uploaded_file').val().split('\\')[$('#uploaded_file').val().split('\\').length-1];
    //     $('.files-name').text(_name)
    // })
</script>

<script>

// var today = new Date();
// var dd = today.getDate();
// var mm = today.getMonth()+1; //January is 0!

// var yyyy = today.getFullYear();
// if(dd < 10){
//     dd = '0' + dd;
// }
// if(mm < 10){
//     mm = '0' + mm;
// }
// var today = yyyy + '-' + mm + '-' + dd;

// $(document).ready(function() {
//     $('#post-date').attr("value", today);
// });



</script>
<?php
include(Document_root.'/Footer.php');
?>