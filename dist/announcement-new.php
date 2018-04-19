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
					<a class="nav-link" href="<?= $urlName ?>/management.php">管理辦法</a>
				</li>
				<?php
					}
				?>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/announcement.php">公告</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/opinionlist.php">住戶意見</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/overduelist.php">欠繳費用</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/overduelist.php">品質管理</a>
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
						echo "<script>window.location.href = '" . $url . "'</script>";
					}
				}
			?>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="./announcement.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增公告</span> <!--回上一頁'資產管理'-->
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="post-create-form" id="post-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="post-date" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>公告日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="post-date" id="post-date" placeholder="公告日期..." >
								</div>
							</div>
                            <div class="form-group row">
								<label for="assets-no" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>公告標題:</label>
								<div class="col-md-9">
									<!-- <input type="text" class="form-control" name="assets-no" id="assets-no" value="<?=$data['asset_no'];?>" placeholder="資產編號..."> -->
                                <!--  -->
                                    <input type="text" name="post-content" form="form-control" placeholder="輸入公告標題...">
                                </div>
							</div>
                            <div class="form-group row">
								<label for="assets-no" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>上傳檔案:</label>
								<div class="col-md-9">
									<!-- <input type="text" class="form-control" name="assets-no" id="assets-no" value="<?=$data['asset_no'];?>" placeholder="資產編號..."> -->
                                <!--  -->
                                    <textarea rows="3" cols="48" name="post-content" form="post-create-form" placeholder="限 PDF 或圖片檔..."></textarea>
                                </div>
							</div>
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">確認</button>
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

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd < 10){
    dd = '0' + dd;
}
if(mm < 10){
    mm = '0' + mm;
}
var today = yyyy + '-' + mm + '-' + dd;

$(document).ready(function() {
    $('#post-date').attr("value", today);
});



</script>
<?php
include(Document_root.'/Footer.php');
?>