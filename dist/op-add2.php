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
					<a class="nav-link active" href="<?= $urlName ?>/opinionlist.php">反映意見</a>
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
        <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/evaluation.php">品質管理</a>
        </li>
				<?php
					}
				?>
			</ul>

			<?php
				if (count($_POST)) {
					$opinion_type = $_POST['opinion-type'];
					$opinion_content = $_POST['opinion-content'];
					$opinion_date = $_POST['opinion-date'];
					$holder_id = $_POST['holder-id'];
					$who = $_POST['who'];
					$sql = "INSERT INTO opinions (`id`,`dt`,`household_id`,`household_type`,`type`,`content`,`dt_responsed`,`dt_completed`) VALUES (NULL, '$opinion_date', $holder_id, )";
					if ($db->insert($sql)) {
						$message="新增成功";
						$url = "./opinionlist.php";
						// $url = "http://www.stackoverflow.com";
						echo "<script>window.location.href = '" . $url . "'</script>";
					}
				}
			?>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/op-add1.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增住戶意見 (意見)</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-12">
						<table class="table asset-table">
							<thead class="thead-light">
								<tr>
									<th>門牌代碼</th>
									<th>戶號</th>
									<th>樓層</th>
									<th>區權人</th>
									<th>現住戶</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$holder_id = $_GET['id'];
									// $db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
									$sql = "SELECT a.id AS id,building,addr_no,floor,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id AND a.id = '$holder_id'";
									$sql = 'SELECT a.* FROM household a';
									$var = $db->getRow($sql);
								?>
								<tr>
									<td><span><?php echo strtoupper($var[short_id]);?></span></td>
									<td><span><?php echo $var[addr_no];?></span></td>
									<td><span><?php echo $var[floor];?></span></td>
									<td><span><?php echo $var[holder];?></span></td>
									<td><span><?php echo $var[resident];?></span></td>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<input name="holder-id" value="<?php echo $holder_id;?>" hidden>
							<div class="form-group row">
								<label for="opinion-type" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>類別:
								</label>
								<div class="col-md-9">
									<select class="custom-select" name="opinion-type">
										<?php
											$sql =  "SELECT * FROM opinion_type";
											$data1 = $db->getRows($sql);
											foreach($data1 as $var) {
										?>
										<option value="<?=$var['id'];?>"><?=$var['type'];?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="opinion" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>意見:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="opinion-content" id="opinion-content" placeholder="反映內容...">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-buy-date" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>反映日期:
								</label>
								<div class="col-md-9">
									<input type="text" class="form-control datepicker" name="opinion-date" id="opinion-date" placeholder="反映日期..." >
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-use-state" class="text-right col-md-3 col-form-label">
									<span class="important">*</span>反映人:
								</label>
								<div class="col-md-9">
									<select class="custom-select" name="who">
										<?php
											$sql =  "SELECT * FROM whois";
											$data = $db->getRows($sql);
											foreach($data as $var) {
										?>
											<option value="<?=$var['id'];?>"><?=$var['who'];?></option>
										<?php
											}
										?>
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
    $('#opinion-date').attr("value", today);
});



</script>

<?php
include(Document_root.'/Footer.php');
?>