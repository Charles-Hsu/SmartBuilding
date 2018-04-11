<?php 
include('../config.php');
include(Document_root.'/Header.php'); 

session_start();

$message = "";

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

if(count($_POST)>0) {

//	var_dump($_POST);

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
}

$id = $_GET['id'];
$building = $_GET['building'];
$floor = $_GET['floor'];
$addr_no = $_GET['addr_no'];
$holder = $_GET['holder'];

//$addr_no = $_GET['addr_no'];
//$floor = $_GET['floor'];
//$sql = 'SELECT * FROM household WHERE addr_no = "' . $addr_no . '" AND floor ="' . $floor . '"';
// $sql = 'SELECT * FROM household WHERE id = ' . $id;
$sql = "SELECT b.id, b.type, a.fee, a.m ,a.id as recordId FROM hoa_fee_record a, hoa_fee_type b WHERE hid = $id AND b.id = a.fee_type";

$data = $db->getRows($sql);
// var_dump($data);
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
					<a class="nav-link active" href="/smartbuilding/assets/household.php">產權管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/sellrent.php">租售管理</a>
                </li>
                

				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/brokerman.php">帶看管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/hoa_fee.php">管理費</a>
				</li>

			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="/smartbuilding/assets/household.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>管理費未繳明細</span>
				</div>

				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>戶號</th>
							<th>樓層</th>
							<th>區權人</th>
							<th>月份</th>
							<th>費用</th>
                            <th>金額</th>
                            <th>繳納</th>
						</tr>
					</thead>
					<tbody>


<?php
	foreach($data as $var) {
?>

						<tr>
							<td><span><?=$addr_no;?></span></td>
							<td><span><?=$floor;?></span></td>
							<td><span><?=$holder;?></span></td>
							<td><span><?=$var[m];?></span></td>
							<td><span><?=$var[type];?></span></td>
                            <td><span><?=$var[fee];?></span></td>
                            <td><span><input type = "checkbox" id="<?php echo $var['recordId'] ?>" class="check-paid" value="<?=$var[m];?>,<?=$var[id];?>"></span></td>
						</tr>
<?php
	}
?>
					</tbody>
				</table>
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

$('.check-paid').on('change',function(){
	var _this=$(this);
	var recordId=_this.attr('id');
	$.ajax({
		url:'../data/household-feelistData.php',
		method:'POST',
		data:{
			recordId
		},
		success:function(data){
			try{
				let _data=JSON.parse(data);
				if(_data.success){
					_this.closest('span').html(_data.data)
				}else{
					alert('請重新操作');
				}
			}catch(error){
				alert(data)
			}
		},
		error:function(error){
			console.log(error)
		}
	})
})

$('.asset-table').DataTable({
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
    "processing": true,
	"ordering": true,
    "order": [[3, 'asc']],
    "searching": false,
})
</script>

<?php 
include(Document_root.'/Footer.php');
?>