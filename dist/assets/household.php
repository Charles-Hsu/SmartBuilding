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
				<a href="/smartbuilding/assets/household-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增產權
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>大樓</th>
							<th>戶號</th>
							<th>樓層</th>
							<th>住戶狀態</th>
							<th>區權人</th>
							<th>現住戶</th>
							<th>欠繳</th>
							<th>明細</th>
							<th>產權</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = 'SELECT a.id AS id,building,addr_no,floor,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id';
							$data = $db->getRows($sql);
							foreach($data as $var) {
						?>
						<tr>
							<td><span><?php echo $var[building];?></span></td>
							<td><span><?php echo $var[addr_no];?></span></td>
							<td><span><?php echo $var[floor];?></span></td>
							<td><span><?php echo $var[status];?></span></td>
							<td><span><?php echo $var[holder];?></span></td>
							<td><span><?php echo $var[resident];?></span></td>
							<td>
								<?php
									$sql = "SELECT SUM(fee) AS s FROM hoa_fee_record WHERE hid = $var[id] AND p IS NULL";
									$s = $db->getRow($sql);
									$s = $s['s'];
								?>
								<span><?php echo number_format($s);?></span>
							</td>
							<td>
<?php
	if($var[unpaid_total] != 0) {
		if (false) {
?>
								<a href="#" data-id="<?php echo $var[id];?>" class="show-details btn btn-outline-secondary">顯示</a>
<?php
		} else {
?>

								<a href="/smartbuilding/assets/household-fee-list.php?id=<?php echo $var[id];?>&floor=<?php echo $var[floor];?>&addr_no=<?php echo $var[addr_no]?>&holder=<?php echo $var[holder];?>" class="btn btn-outline-secondary">顯示</a>
<?php
		}
	}
?>
							</td>
							<td><a href="/smartbuilding/assets/household-edit.php?id=<?php echo $var[id];?>" class="btn btn-outline-secondary">修改</a></td>
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

<div id="details-model" class="details-model">
	<div id="details-head" class="details-head">
		<span>欠繳費用明細</span>
		<span class="close-modal">X</span>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>費用</th>
				<th>金額</th>
				<th>月份</th>
			</tr>
		</thead>
		<tbody id="details-tbody">

		</tbody>
	</table>
</div>
<script>
var moveX = 0, moveY = 0, x = 0, y = 0;
var detailsHead=document.getElementById('details-head');
var detailsModel=document.getElementById('details-model');

detailsHead.onmousedown=function(e){
	x=e.clientX;
	y=e.clientY;
	document.onmouseup=function(e){
		document.onmouseup = null;
    	document.onmousemove = null;
	}
	document.onmousemove=function(e){
		moveX=x-e.clientX;
		moveY=y-e.clientY;
		x=e.clientX;
		y=e.clientY;
		detailsModel.style.top=(detailsModel.offsetTop-moveY)+'px';
		detailsModel.style.left=(detailsModel.offsetLeft-moveX)+'px';
	}
}
$('.close-modal').on('click',function(){
	$('.details-model').hide()
})
$('.show-details').on('click',function(e){
	e.preventDefault();
	$.ajax({
		url:'./household-data.php',
		method:'POST',
		data:{id:$(this).attr('data-id')},
		success:function(data){
			var datalist=JSON.parse(data);
			var str = "";
			str="<tr><td>{{type}}</td><td>{{fee}}</td><td>{{m}}</td></tr>";
			if(datalist[0] == 1){
				var strParse = "";
				$('.details-model').show()
				for(var item in datalist[1]){
					strParse +=
						str.replace('{{type}}',datalist[1][item].type)
						.replace('{{fee}}',datalist[1][item].fee)
						.replace('{{m}}',datalist[1][item].m)
				}
				$('#details-tbody').html(strParse)
			}
		},
		error:function(){
			console.log(123)
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
})
</script>
<?php
include(Document_root.'/Footer.php');
?>