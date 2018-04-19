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
	$contract_id = $_GET['contract_id'];
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
					<a class="nav-link" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>

                <!-- <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li> -->
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/org/contracts.php" class="btn add-asset-btn mb-3">
					<span>+</span>廠商自評
				</a>
				<!-- <a href="<?= $urlName ?>/org/contract-man.php" class="btn add-asset-btn mb-3">
					<span>+</span>協約管理
				</a> -->
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>合約日期</th>
							<th>廠商名稱</th>
							<th>合約類別</th>
							<!-- <th>評分</th> -->
							<th>聯絡人</th>
							<th>聯絡方式</th>
							<!-- <th>修改</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT score,dt,name,contact_person,contact_phone,b.item AS item FROM contract a, contract_item b WHERE a.id != 0 AND a.contract_item = b.id AND a.id = $contract_id";
							// echo $sql;
							$data = $db->getRows($sql);
							foreach($data as $var) {
						?>
						<tr>
							<td><span><?php echo $var['dt'];?></span></td>
							<td><span><?php echo $var['name'];?></span></td>
							<td><span><?php echo $var['item'];?></span></td>
							<td><span><?php echo $var['contact_person'];?></span></td>
							<td><span><?php echo $var['contact_phone'];?></span></td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>



				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
							<div class="form-group row">
								<label for="household-area" class="text-right col-lg-6 col-md-3 col-form-label">
									招標:</label>
								<div class="col-lg-6 col-md-9">
								<label for="household-area" class="text-right col-lg-6 col-md-3 col-form-label">
									準備招標文件:</label>
								<div class="col-lg-6 col-md-9">
                    				<input type="number" min="1" max="4" class="form-control" value="1" >
								</div>
							</div>
							<div class="form-group row">
								<label for="household-use" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>房子用途:
								</label>
								<div class="col-lg-6 col-md-9">
									<select name="household-use" id="household-use" class="form-control">
										<?php
											$sql =  "SELECT id,name FROM household_purpose";
											$data = $db->getRows($sql);
											foreach($data as $var) {
												$selected = "";
												if ($var['id'] == $household['purpose']) {
													$selected = 'selected';
												}
										?>
										<option value="<?=$var['id'];?>" <?=$selected;?>><?=$var['name'];?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-status" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>房子狀態:</label>
								<div class="col-lg-6 col-md-9">
									<select name="household-status" id="household-status" class="form-control">
<!--
										<option value="" selected>選擇用途</option>
-->
<?php
$sql =  "SELECT id,name FROM household_status";
$data = $db->getRows($sql);
foreach($data as $var) {
//	echo $var['Name'];
//echo $var['id'];
	$selected = "";
	if ($var['id'] == $household['status']) {
		$selected = 'selected';
	}
?>
									<option value="<?=$var['id'];?>" <?=$selected;?>><?=$var['name'];?></option>
<?php
}
?>
<!--
										<option value="自用">自用</option>
										<option value="出租">出租</option>
-->
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-num" class="text-right col-lg-6 col-md-3 col-form-label">
									戶號:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" value="<?=$household['addr_no'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-floor" class="text-right col-lg-6 col-md-3 col-form-label">
									樓層:
								</label>
								<div class="col-lg-6 col-md-9">
                                <input type="text" class="form-control" value="<?=$household['floor'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-own" class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>區權人:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-own" id="household-own" value="<?=$household['holder'];?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-name" class="text-right col-lg-4 offset-lg-2 col-md-3 col-form-label">
									<span class="important">*</span>住戶姓名:
								</label>
								<div class="col-lg-4 col-md-6">
									<input type="text" class="form-control" name="household-name" id="household-name" value="<?=$household['resident'];?>">
								</div>
								<div class="col-lg-2 col-md-3 pl-0 ">
									<button class="btn btn-primary btn-same">同區權人</button>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-props" class="text-right col-lg-6 col-md-3 col-form-label">區權比例:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" value="<?=$household['owner_percentage']?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-sqft" class="text-right col-lg-6 col-md-3 col-form-label">坪數:</label>
								<div class="col-lg-6 col-md-9">
                                <input type="text" class="form-control" value="<?=$household['space'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-style" class="text-right col-lg-6 col-md-3 col-form-label">房型:</label>
								<div class="col-lg-6 col-md-9">
                                <input type="text" class="form-control" value="<?=$household['house_type'];?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-guard-amount" class="text-right col-lg-6 col-md-3 col-form-label">應收管理費金額:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-guard-amount" id="household-guard-amount" value="<?=$household['due'];?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-park-amount" class="text-right col-lg-6 col-md-3 col-form-label">應收停車費金額:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-park-amount" id="household-park-amount" value="<?=$household['parking_lot_due'];?>">
								</div>
							</div>
<!--
							<div class="form-group row">
								<label for="household-park-amount" class="text-right col-md-4 col-form-label">帶看費用:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-park-amount" id="household-park-amount" placeholder="應收停車費金額..." value="">
								</div>
							</div>
-->
							<div class="form-group row">
								<label for="assets-buy-date" class="text-right col-lg-6 col-md-3 col-form-label">
									購置日期:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control datepicker" name="assets-buy-date" id="assets-buy-date" value="<?=$household['buy_date'];?>" >
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-use-state" class="text-right col-lg-6 col-md-3 col-form-label">
									使用狀態:
								</label>
								<div class="col-lg-6 col-md-9">
									<select class="custom-select" name="assets-use-state">
<!--
										<option selected>選取狀態</option>
-->
<?php
$sql =  "SELECT id,name FROM household_used_for";
$data = $db->getRows($sql);
foreach($data as $var) {
//	echo $var['Name'];
//echo $var['id'];
    $selected = "";
    if ($var['id'] == $household['used_for']) {
        $selected = 'selected';
    }
?>
									<option value="<?=$var['id'];?>" <?=$selected;?>><?=$var['name'];?></option>
<?php
}
?>
<!--
										<option value="自用">自用</option>
										<option value="租賃">租賃</option>
-->
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-6 offset-md-3 col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">更新</button>
									<button class="btn assets-btn assets-cancel-btn">取消</button>
								</div>
							</div>
<?php if($message!="") { ?>
                   		<div class="message"><?php echo $message; ?></div>
<?php } ?>


						</form>
					</div>
				</div>


		</div>
	</div>
</div>

<script>
$('.asset-table').DataTable({
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋資產...",
		"info": "從 _START_ 到 _END_ /共 _TOTAL_ 筆資料",
		"infoEmpty": "",
		"emptyTable": "目前沒有資料",
		"lengthMenu": "每頁顯示 _MENU_ 筆資料",
		"zeroRecords": "搜尋無此資料",
		"infoFiltered": " 搜尋結果 _MAX_ 筆資料",
		"paginate": {
			"previous": "上一頁",
			"next": "下一頁",
			"first": "第一頁",
			"last": "最後一頁"
		}
	},
	"deferRender": true,
	"processing": true
})
</script>
<?php include('../Footer.php'); ?>