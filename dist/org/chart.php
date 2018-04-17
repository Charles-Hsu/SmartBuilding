<?php
include('../config.php');
include('../Header.php');
?>
<?php


if (count($_POST) > 0) {
	echo "hello world";
	var_dump($_POST);
}

$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);

if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
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
					<a class="nav-link" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>

                <!-- <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li> -->
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/org/chart-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增委員
				</a>
				<a href="<?= $urlName ?>/org/chart-edit.php" class="btn add-asset-btn mb-3">
					<span>+</span>委員會改選
				</a>
				<a href="<?= $urlName ?>/org/chart-committee-add.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增下一屆
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>屆別</th>
							<th>職稱</th>
							<th>戶號</th>
							<th>樓層</th>
							<th>姓名</th>
							<th>編輯</th>
						</tr>
					</thead>
					<tbody class="chart-tbody">
						<?php
							$sql = "SELECT session AS session_id FROM committee ORDER BY session DESC LIMIT 1";
							$data = $db->getRow($sql);
							$current_session_id = $data['session_id'];

							$sql = "SELECT d.holder, d.addr_no, d.floor, c.name AS session_name, c.id AS session_id, b.title, b.id AS role_id FROM committee a, committee_role b, session c, household d WHERE a.role_id = b.id AND a.session = c.id AND d.id = a.holder_id AND a.session = $current_session_id";

							$data = $db->getRows($sql);
							foreach($data as $var) {
						?>
						<tr>
							<td><div><?=$var['session_name'];?></div></td>
							<td class="data-title"><div id="title"><?=$var['title'];?></div></td>
							<td class="data-addr_no">
								<select  class="form-control" name="addr_no" id="addr_no" disabled>
								<?php
								$sql = "SELECT distinct addr_no FROM `household`";
								$dd = $db->getRows($sql);
								$addr_no = $var['addr_no'];
								foreach ($dd as $t) {
								?>
									<option value="<?php echo $t['addr_no'];?>" <?php echo !strcmp($t['addr_no'], $addr_no) ? "selected" : "";?>><?php echo $t['addr_no'];?></option>
								<?php
								}
								?>
								</select>
							</td>
							<td class="data-floor">
								<select class="form-control" name="floor" id="floor" disabled>
									<?php
									$sql = "SELECT distinct floor FROM `household` ORDER BY floor*1";
									$dd = $db->getRows($sql);
									$floor = $var['floor'];
									foreach ($dd as $t) {
									?>
										<option value="<?php echo $t['floor'];?>" <?php echo !strcmp($t['floor'], $floor) ? "selected" : "";?>><?php echo $t['floor'];?></option>
									<?php
									}
									?>
								</select>
							</td>
							<td class="data-holder"><div id="holder"><?=$var['holder'];?></div></td>
							<td>
								<button class="btn btn-primary disableClick">修改</button>
							</td>
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

<?php
$sql = "SELECT * FROM `household`";
$data=$db->getRows($sql);
?>
<script>
var chartData=<?php echo json_encode($data)  ?>;
$('#addr_no').on('change',function(e){
	// var _val=$('#household-own').val()
	// $('#household-name').val(_val)
	// e.preventDefault()
	$("#addr_no").css("pointer-events", "auto");
})
$('.chart-tbody').on('click','.disableClick',function(){
	$(this).closest('tr').find('td select').prop('disabled',false)
	var submitBtn=`
		<div class="btn-group">
			<button class="btn btn-success submitClick ">確認</button>
			<button class="btn btn-secondry cancelClick ">取消</button>
		</div>
	`;
	$(this).closest('td').html(submitBtn)
})

$('.chart-tbody').on('click','.submitClick',function(){
	var _this=$(this);
	var data={};
	var title=$(this).closest('tr').find('td #title').text()
	var addr_no=$(this).closest('tr').find('td.data-addr_no #addr_no').val()
	var floor=$(this).closest('tr').find('td.data-floor #floor').val()
	var holder=$(this).closest('tr').find('td #holder').text()
	data={title,addr_no,floor,holder}
	console.log(data)
	$.ajax({
		url:'../data/chartData.php',
		method:'POST',
		data:data,
		success:function(data){
			try{
				var _data=JSON.parse(data);
				if(_data.success){
					_this.closest('tr').find('td select').prop('disabled',true)
					_this.closest('td').html("<button class='btn btn-primary disableClick'>修改</button>")
					// console.log(_data.data)
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

$('.chart-tbody').on('change','#addr_no',function(){
	var addr_no=$(this).val();
	var floor=$('#floor').val();
	var getName=chartData.filter((item,index)=>{
		return item.addr_no == addr_no && item.floor == floor;
	})
	if(getName.length > 0){
		$('#holder').text(getName[0].holder)
	}else{
		$('#holder').text('')
	}
})
$('.chart-tbody').on('change','#floor',function(){
	var addr_no=$('#addr_no').val();
	var floor=$(this).val();
	var getName=chartData.filter((item,index)=>{
		return item.addr_no == addr_no && item.floor == floor;
	})
	if(getName.length > 0){
		$('#holder').text(getName[0].holder)
	}else{
		$('#holder').text('')
	}
})
$('.chart-tbody').on('click','.cancelClick',function(){
	$(this).closest('tr').find('td select').prop('disabled',true)
	$(this).closest('td').html("<button class='btn btn-primary disableClick'>修改</button>")
})

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