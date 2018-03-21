<?php 
include('../config.php');
include(Document_root.'/Header.php'); 

session_start();

$message = "";

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

if(count($_POST)>0) {

	var_dump($_POST);

	$data = array();

	$data['building'] = $_POST['household-area'];
	$data['purpose'] = $_POST['household-use'];
	$data['status'] = $_POST['household-status'];
	$data['addr_no'] = $_POST['household-num'];
	$data['floor'] = $_POST['household-floor'];
	$data['holder'] = $_POST['household-own'];
	$data['resident'] = $_POST['household-name'];
	$data['owner_percentage'] = $_POST['household-props'];
	$data['space'] = $_POST['household-sqft'];
	$data['house_type'] = $_POST['household-style'];
	$data['due'] = $_POST['household-guard-amount'];
	$data['parking_lot_due'] = $_POST['household-park-amoun'];
	$data['buy_date'] = $_POST['assets-buy-date'];
	$data['used_for'] = $_POST['assets-use-state'];

	$fields = "";
	$values = "";

	foreach ($data as $key => $value) {
		$fields = $fields . "`" . $key . "`,";
		$values = $values . "'" . $value . "',"; 
	}

	$fields = substr($fields, 0, strlen($fields)-1);
	$values = substr($values, 0, strlen($values)-1);
	$sql = 'INSERT INTO household (' . $fields . ') ' . ' VALUES (' . $values . ')';
	echo $sql;
	
	if ($db->insert($sql)) {
	//if ($db->insertRow($table, $data)) {
		$message="新增成功";
	}


/*
	$sql =  "SELECT count(*) AS n FROM household WHERE asset_no='" . $_POST['assets-no']. "'";
	$data = $db->getValue($sql);

	if ($data != 0) {
		$message="資產編號重複";
	} else {
		$sql =  "SELECT count(*) AS n FROM assets WHERE asset_name='" . $_POST['assets-name']. "'";
		$data = $db->getValue($sql);
		if ($data != 0) {
			$message="資產名稱重複";
		}
	}
	//echo " message = [" . $message . "]";
	if ($message == "") {
		if ($_POST['assets-no'] == "") {
			$message="資產編號不能空白";
		} else if ($_POST['assets-name'] == "") {
			$message="資產名稱不能空白";
		} else if ($_POST['assets-buy-date'] == "") {
			$message="請輸入購置日期";
		} else if ($_POST['assets-use-state'] == "") {
			$message="請選擇使用狀態";
		} else {

			$data = array();
			$data['asset_no'] = $_POST['assets-no'];
			$data['asset_name'] = $_POST['assets-name'];
			$data['asset_category'] = $_POST['assets-sort'];
			$data['price'] = $_POST['assets-price'];
			$data['amount'] = $_POST['assets-amount'];
			$data['order_by'] = $_POST['assets-man'];
			$data['order_date'] = $_POST['assets-buy-date'];
			$data['status_no'] = $_POST['assets-use-state'];

			$fields = "";
			$values = "";

			foreach ($data as $key => $value) {
				$fields = $fields . "`" . $key . "`,";
				$values = $values . "'" . $value . "',"; 
			}

			$fields = substr($fields, 0, strlen($fields)-1);
			$values = substr($values, 0, strlen($values)-1);
			$sql = 'INSERT INTO ' . $table . ' (' . $fields . ') ' . ' VALUES (' . $values . ')';
			echo $sql;
			
			if ($db->insert($sql)) {
			//if ($db->insertRow($table, $data)) {
				$message="新增成功";
			}
		}
	}
	*/
}


?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/assets/household.php">物件管理</a>
				</li>
<!--				
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/assets/infrastructure.php">公共設施</a>
				</li>
-->				
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/assets/household.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>新增物件</span>
				</div>
				<div class="row justify-content-between">
					<div class="col-lg-5 col-6">
						<form class="householdCreate-form" action="" method="POST">
<!--							
							<div class="form-group row">
								<label for="community" class="text-right col-lg-6 col-md-4 col-form-label">所屬社區:</label>
								<div class="col-lg-6 col-md-8 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
-->							
							<div class="form-group row">
								<label for="household-area" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>所屬大樓:</label>
								<div class="col-md-8">
									<select name="household-area" id="household-area" class="form-control">

<?php
$sql =  "SELECT name FROM building";
$data = $db->getRows($sql);
foreach($data as $var) {
//	echo $var['Name'];
//echo $var['id'];
?>
									<option value="<?=$var['name'];?>"><?=$var['name'];?></option>
<?php
}
?>
<!--
										<option value="" selected>選擇大樓</option>
										<option value="AA">忠孝樓</option>
										<option value="BB">仁愛樓</option>
-->										
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-use" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>房子用途:</label>
								<div class="col-md-8">
									<select name="household-use" id="household-use" class="form-control">
<!--									
										<option value="" selected>選擇用途</option>
-->							

<?php
$sql =  "SELECT id,name FROM household_purpose";
$data = $db->getRows($sql);
foreach($data as $var) {
//	echo $var['Name'];
//echo $var['id'];
?>
									<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
<?php
}
?>
<!--
										<option value="住宅用">住宅用</option>
										<option value="商業用">商業用</option>
-->										
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-status" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>房子狀態:</label>
								<div class="col-md-8">
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
?>
									<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
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
								<label for="household-num" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>戶號:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-num" id="household-num" placeholder="戶號..." value="" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-floor" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>樓層:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-floor" id="household-floor" placeholder="樓層..." value="" requiredrequired>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-own" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>區權人:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-own" id="household-own" placeholder="區權人..." value="" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-name" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>住戶姓名:
								</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="household-name" id="household-name" placeholder="住戶姓名..." value="" required>
								</div>
								<div class="col-md-2 pl-0 ">
									<button class="btn btn-primary btn-same">同區權人</button>
								</div>
							</div>
							<div class="form-group row">
								<label for="household-props" class="text-right col-md-4 col-form-label">區權比例:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-props" id="household-props" placeholder="區權比例..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-sqft" class="text-right col-md-4 col-form-label">坪數:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-sqft" id="household-sqft" placeholder="坪數..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-style" class="text-right col-md-4 col-form-label">房型:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-style" id="household-style" placeholder="?房?廳" value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-guard-amount" class="text-right col-md-4 col-form-label">應收管理費金額:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-guard-amount" id="household-guard-amount" placeholder="應收管理費金額..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="household-park-amount" class="text-right col-md-4 col-form-label">應收停車費金額:</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="household-park-amount" id="household-park-amount" placeholder="應收停車費金額..." value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-buy-date" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>購置日期:
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control datepicker" name="assets-buy-date" id="assets-buy-date" placeholder="購置日期..." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="assets-use-state" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>使用狀態:
								</label>
								<div class="col-md-8">
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
?>
									<option value="<?=$var['id'];?>"><?=$var['name'];?></option>
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
								<div class=" col-md-8 offset-md-4">
									<button type="submit" class="btn btn-outline-secondary">新增</button>
									<button type="reset" class="btn btn-outline-secondary btn-cancel">取消</button>
								</div>
							</div>
<?php if($message!="") { ?>
                   		<div class="message"><?php echo $message; ?></div>
<?php } ?>


						</form>
					</div>
					<div class="col-lg-6 col-6">
						<nav class="mb-3 householdInner-menu">
							<a href="javascript:;" class="active"><i class="fas fa-list-ul mr-2"></i>規費紀錄</a>
							<a href="javascript:;" class=""><i class="far fa-file-alt mr-2"></i>租賃文件</a>
						</nav>
						<div class="householdInner-tabs">
							<div class="household-tab show" id="householdRecords-tab">
								<select name="householdHistory-select" id="householdHistory-select" class="mb-3 form-control col-6">
									<option value="" selected>請選擇年分</option>
									<option value="2018">2018年</option>
									<option value="2017">2017年</option>
								</select>
								<a href="./householdRecords-create.php" class="btn btn-primary mb-3">新增繳費紀錄</a>
								<table class="table table-bordered asset-table householdRecords-table">
									<thead>
										<tr>
											<th>費用</th>
											<th>繳交日期</th>
											<th>應收金額</th>
											<th>實收金額</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>2018-03停車費</td>
											<td>2017-03-07</td>
											<td>4000</td>
											<td>3900</td>
										</tr>
										<tr>
											<td>2017-03停車費</td>
											<td>2018-03-07</td>
											<td>4000</td>
											<td>3900</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="household-tab" id="householdLease-doc">
								<a href="./householdLease-create.php" class="btn btn-primary mb-3">新增租賃文件</a>
								<table class="table table-bordered householdLease-table">
									<thead>
										<tr>
											<th>仲介名稱</th>
											<th>委託書</th>
											<th>下載</th>
											<th>租賃文件</th>
											<th>下載</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>信義房屋</td>
											<td><a href="#">螢幕快照 2018-03-07.png</a></td>
											<td><a href="#" class="btn btn-primary">下載檔案</a></td>
											<td><a href="#">螢幕快照 2018-03-07.png</a></td>
											<td><a href="#" class="btn btn-primary">下載檔案</a></td>
										</tr>
										<tr>
											<td>信義房屋</td>
											<td><a href="#">螢幕快照 2017-03-07.png</a></td>
											<td><a href="#" class="btn btn-primary">下載檔案</a></td>
											<td><a href="#">螢幕快照 2017-03-07.png</a></td>
											<td><a href="#" class="btn btn-primary">下載檔案</a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$('.btn-same').on('click',function(e){
	var _val=$('#household-own').val()
	$('#household-name').val(_val)
	e.preventDefault()
})
$('.householdCreate-form').on('submit',function(e){
	if($('#household-num').val().length <= 0){
		e.preventDefault();
		alert('請輸入戶號')
		return;
	}
	if($('#household-floor').val().length <= 0){
		e.preventDefault();
		alert('請輸入樓層')
		return;
	}
	if($('#household-own').val().length <= 0){
		e.preventDefault();
		alert('請輸入區權人')
		return;
	}
	if($('#household-name').val().length <= 0){
		e.preventDefault();
		alert('請輸入住戶姓名')
		return;
	}
	if($('#assets-buy-date').val().length <= 0){
		e.preventDefault();
		alert('請輸入購置日期')
		return;
	}
})
$('.householdInner-menu > a').on('click',function(){
	var _index=$(this).index();
	$(this).addClass('active').siblings().removeClass('active');
	$(this).closest('.householdInner-menu').next().find('.household-tab').eq(_index).addClass('show').siblings().removeClass('show')
})
var  table=$('.asset-table').DataTable({
	"ordering": false,
	dom:'lBrtip',
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋住戶...",
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
$('#householdHistory-select').on('change',function(){
	table.columns(0).search($(this).val()).draw()
})
$('.householdLease-table').DataTable({
	"ordering": false,
	dom:'lBrtip',
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋住戶...",
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
<?php 
include(Document_root.'/Footer.php');
?>