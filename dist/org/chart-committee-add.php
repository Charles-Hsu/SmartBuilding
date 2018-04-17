<?php 
include('../config.php');
include('../Header.php'); 

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

session_start();

function newCommittee($db, $current_session) {
	$sql = "SELECT `role_id`, `holder_id`, `session`
				FROM committee 
				WHERE session = $current_session";
	echo $sql;
	var_dump($db);
	$data = $db->getRows($sql);
	var_dump($data);
	foreach($data AS $var) {
		$n = $var[session]*1+1;
		$sql = "INSERT INTO committee (`id`,`role_id`,`holder_id`,`session`)
				VALUES (NULL, $var[role_id], $var[holder_id], $n)";
		echo $sql;
		$db->insert($sql);
	}
}

if (count($_POST)) {
	var_dump($_POST);
	$current_session = $_POST['current_session_id'];
	echo $current_session;
	newCommittee($db, $current_session);
}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org.php">人員</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/#">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>

                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/mails.php">郵件紀錄</a>
                </li>
                <!-- <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li> -->
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/org/chart.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增下一屆</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="chart-session" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>目前屆別:</label>
								<div class="col-md-8">
									<?php
										$sql = "SELECT b.id, b.name AS session FROM committee a, session b WHERE b.id = a.session order by session desc limit 1";
										$data = $db->getRow($sql);
										$session = $data['session'];
										$session_id = $data['id'];
									?>
									<input type="text" value="<?php echo $session; ?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="chart-session" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>新增下一屆:</label>
								<div class="col-md-8">
									<?php
										$sql = "SELECT name FROM session WHERE id = ($session_id*1+1) order by id desc limit 1";
										echo $sql;
										$data = $db->getRow($sql);
										$session = $data['name'];
									?>
									<input type="text" value="<?php echo $session; ?>" readonly>
									<input name="current_session_id" value="<?php echo $session_id; ?>" hidden>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-primary">確認</button>
									<button class="btn btn-outline-secondary">取消</button>
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