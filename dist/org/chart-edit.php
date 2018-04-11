<?php 
include('../config.php');
include('../Header.php'); 

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

session_start();

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
					<a class="nav-link" href="<?= $urlName ?>/org/household.php">住戶意見</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/works.php">工作日誌</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/mails.php">郵件紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/org/chart.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>改選委員</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-8col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="chart-session" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>屆別:</label>
								<div class="col-md-8">
									<select  class="form-control" name="chart-session" id="chart-session">
										<?php
										$sql = "SELECT session FROM `committee` order by session desc limit 1";
										$data = $db->getRow($sql);
										$session_no = $data['session'];
										$sql = "SELECT id,name FROM session WHERE id > $session_no ORDER BY id ASC LIMIT 2";
										echo $sql;
										$data = $db->getRows($sql);
										foreach ($data as $var) {
										?>
										<option value="<? echo $var['id'];?>"><? echo $var['name'];?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="chart-note" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>職稱:</label>
								<div class="col-md-8">
									<select  class="form-control" name="committee-title" id="committee-titlen">
										<?php
										$sql = "SELECT id,title FROM `committee_role`";
										$data = $db->getRows($sql);
										foreach ($data as $var) {
										?>
										<option value="<? echo $var['id'];?>"><? echo $var['title'];?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="mails-upload" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>區權人:</label>
								<div class="col-md-8">
									<span>戶號：</span>
									<select  class="form-control" name="committee-title" id="committee-titlen">
										<?php
										$sql = "SELECT distinct addr_no FROM `household`";
										$data = $db->getRows($sql);
										foreach ($data as $var) {
										?>
										<option value="<? echo $var['addr_no'];?>"><? echo $var['addr_no'];?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="col-md-8">
									<span>樓層：</span>
									<select  class="form-control" name="committee-title" id="committee-titlen">
										<?php
										$sql = "SELECT distinct floor FROM `household` ORDER BY floor*1 ASC";
										$data = $db->getRows($sql);
										foreach ($data as $var) {
										?>
										<option value="<? echo $var['floor'];?>"><? echo $var['floor'];?></option>
										<?php
										}
										?>
									</select>
								</div>

								<div class="col-md-8">
									<span>姓名：</span><span></span>
									<input type = "text" value="這裡要放選擇樓號和樓層後的區權人姓名，透過js去資料庫撈出來後更新" readonly> 
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