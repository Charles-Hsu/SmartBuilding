<?php 
include('../config.php');
include(Document_root.'/Header.php'); 

session_start();

$message = "";

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$id = $_GET['id'];

if(count($_POST)>0) {

    //var_dump($_POST);
    $datetime = $_POST['agent_datetime'];
    $agent_id = $_POST['agent-id'];
//    echo $datetime;
   /* 
    INSERT INTO `real_estate_agent_event` (`id`, `dt`, `realestate_id`, `agent_id`) VALUES (NULL, '2018-03-22 05:25:23', '1', '5');
    */

    $sql = "INSERT INTO real_estate_agent_event VALUES (NULL, '" . $datetime . "', '" . $id . "', '" . $agent_id . "')";
    //echo $sql;

    if ($db->insert($sql)) {
        //if ($db->insertRow($table, $data)) {
            //$message="新增成功";
    }

/*
	$data = array();

//	$data['building'] = $_POST['household-area'];
	$data['purpose'] = $_POST['household-use'];


//echo "household-use = " . $_POST['household-use'] . "<br>"; 


	$data['status'] = $_POST['household-status'];
    //$data['addr_no'] = $_POST['household-num'];

    $data['addr_no'] = $_GET['addr_no'];
    $data['floor'] = $_GET['floor'];

//	$data['floor'] = $_POST['household-floor'];
	$data['holder'] = $_POST['household-own'];
	$data['resident'] = $_POST['household-name'];
	//$data['owner_percentage'] = $_POST['household-props'];
//	$data['space'] = $_POST['household-sqft'];
//	$data['house_type'] = $_POST['household-style'];
	$data['due'] = $_POST['household-guard-amount'];
	$data['parking_lot_due'] = $_POST['household-park-amoun'];
	$data['buy_date'] = $_POST['assets-buy-date'];
	$data['used_for'] = $_POST['assets-use-state'];

    $sql = 'UPDATE household SET purpose = ' . $data["purpose"] . ', status = ' . $data['status'] . ', holder = "' . $data['holder'] . '", resident = "' . $data['resident'] . '", due = "' . $data['due'] . '", parking_lot_due = "' . $data['parking_lot_due'] . '", buy_date = "' . $data['buy_date'] . '", used_for = ' . $data['used_for'] . ' WHERE addr_no = "' . $data['addr_no'] . '" AND floor = "' . $data['floor'] . '"';
    
	//echo $sql;
	
	if ($db->insert($sql)) {
	//if ($db->insertRow($table, $data)) {
		$message="修改成功";
    }
    */
}


//$addr_no = $_GET['addr_no'];
//$floor = $_GET['floor'];
//$sql = 'SELECT * FROM household WHERE addr_no = "' . $addr_no . '" AND floor ="' . $floor . '"';
$sql = 'SELECT * FROM household WHERE id = ' . $id;
$household = $db->getRow($sql);
//var_dump($household);

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets.php">資產管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/household.php">產權管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/sellrent.php">租售管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="/smartbuilding/assets/brokerman.php">帶看管理</a>
				</li>
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/assets/brokerman.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>帶看管理</span>
				</div>
				<div class="row justify-content-lg-start justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-12">
						<form class="assets-create-form" action="" method="POST">
<!--							
							<div class="form-group row">
								<label for="community" class="text-right col-lg-6 col-md-3 col-form-label">所屬社區:</label>
								<div class="col-lg-6 col-md-9 d-flex align-items-center">
									<span>XXXXXX</span>
								</div>
							</div>
-->							
							<div class="form-group row">
								<label for="household-area" class="text-right col-lg-6 col-md-3 col-form-label">
									所屬大樓:</label>
								<div class="col-lg-6 col-md-9">
                    				<input type="text" class="form-control" value="<?=$household['building'];?>" readonly>
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
									區權人:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-own" id="household-own" value="<?=$household['holder'];?>" readonly>
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
								<label for="household-guard-amount" class="text-right col-lg-6 col-md-3 col-form-label">帶看費用:</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control" name="household-guard-amount" id="household-guard-amount" value="<?=$household['due'];?>" readonly>
								</div>
							</div>

							<div class="form-group row">
								<label class="text-right col-lg-6 col-md-3 col-form-label">仲介公司:</label>
								<div class="col-lg-6 col-md-9">
                                <select name="agent-id" class="form-control">
<!--									
										<option value="" selected>選擇用途</option>
-->							

<?php
/*
$sql =  "SELECT id,name FROM household_purpose";
$data = $db->getRows($sql);
*/

$sql = 'SELECT * FROM real_estate_agent';
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
								<label class="text-right col-lg-6 col-md-3 col-form-label">
									<span class="important">*</span>帶看日期:
								</label>
								<div class="col-lg-6 col-md-9">
									<input type="text" class="form-control datepicker" data-type="datetime" name="agent_datetime">
								</div>
							</div>



<!--

							<div class="form-group row">
								<label for="household-status" class="text-right col-md-4 col-form-label">
									<span class="important">*</span>租/售:</label>
								<div class="col-md-8">
									<select name="household-status" id="household-status" class="form-control">
										<option value="1">出租</option>
										<option value="0">出售</option>
									</select>
								</div>
							</div>
-->


    						<div class="form-group row">
								<div class="col-lg-6 offset-lg-6 offset-md-3 col-md-9 offset-md-3">
									<button class="btn assets-btn assets-add-btn">新增</button>
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
    
<?php
    $sql = 'SELECT *, b.name FROM real_estate_agent_event a, real_estate_agent b WHERE household_id = ' . $id . ' AND agent_id = b.id';
    //echo $sql;
    $data = $db->getRows($sql);
    //var_dump($data);
?>

				<table class="table datatable">
					<thead class="thead-light">
						<tr>
							<th>日期/時間</th>
							<th>仲介公司</th>
						</tr>
					</thead>
					<tbody>
<?php
	foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>

						<tr>
							<td><span><?=$var[dt]?></span></td>
							<td><span><?=$var[name]?></span></td>
						</tr>
<?php
	}
?>
					</tbody>
				</table>

</div>
<script>
$('.btn-same').on('click',function(e){
	var _val=$('#household-own').val()
	$('#household-name').val(_val)
	e.preventDefault()
})
</script>
<script>
	var now_date=new Date();
	var now_year=now_date.getFullYear();
	var now_month=now_date.getMonth()+1;
	var now_date=now_date.getDate();
	if(now_month<10){
		now_month='0'+now_month
	}
	if(now_date<10){
		now_date='0'+now_date
	}
	$('.datepicker').val(`${now_year}-${now_month}-${now_date}`)
</script>
<script>
$('.datatable').DataTable({
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
	"processing": true,
    "order": [[0, 'desc']],
    //"order": [[0, 'asc']],
})
</script>
<?php 
include(Document_root.'/Footer.php');
?>