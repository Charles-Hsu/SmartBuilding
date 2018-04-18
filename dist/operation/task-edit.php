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
	$id = 0;
	if ($_GET) {
		$id = $_GET['id'];
	}
	if (count($_POST) > 0) {
		$sql = "UPDATE tasks SET dt = '" . $_POST['op-dt'] . "' WHERE id = '" . $_POST['task-id'] . "'";
		$db->update($sql);
	}
	$sql = 'SELECT a.id AS taks_id, a.dt AS dt, a.descript, b.item, c.name AS contractor FROM tasks a, contract_item b, contract c WHERE a.category_id = b.id AND a.contract_id = c.id AND a.id = ' . $id;
	$data = $db->getRow($sql);
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
		    <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/operation.php">例行作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/budget.php">年度預算</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/operation.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>修改例行作業</span>
                </div>

				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">


                            <input type="hidden" name="task-id" value="<?=$id;?>">


<!--
							<div class="form-group row">
								<label for="community" class="text-right col-md-4 col-form-label">所屬社區:</label>
								<div class="col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
                            </div>
-->

<?php
$var = $data;

?>


							<div class="form-group row">
								<label for="operation-project" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>作業時間:</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="op-dt" value="<?=$var['dt'];?>">
								</div>
                            </div>


							<div class="form-group row">
								<label for="operation-type" class="text-right col-md-4 col-form-label">
									作業類別:</label>
                                <div class="col-md-8">
									<input type="text" class="form-control" name="op-cat" value="<?=$var['item'];?>" readonly>
								</div>
                            </div>
							<div class="form-group row">
								<label for="operation-contractor" class="text-right col-md-4 col-form-label">
									承包廠商:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="op-contractor" value="<?=$var['contractor'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="orgstaff-company" class="text-right col-md-4 col-form-label">
									作業內容:
								</label>
								<div class="col-md-8">
                                <input type="text" class="form-control" name="op-content" value="<?=$var['descript'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-primary">儲存</button>
                                    <button class="btn btn-outline-secondary">取消</button>
<!--
                                    <button class="btn btn-outline-danger">刪除該人員</button>
-->
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