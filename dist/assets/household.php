<?php 
include('../config.php');
include(Document_root.'/Header.php'); 
?>

<?php 

$sql = 'SELECT a.*, b.name AS status FROM assets a, asset_status b WHERE a.status_no = b.id';
/*
							<td><span><?=$var[building]?></span></td>
							<td><span><?=$var[addr_no]?></span></td>
							<td><span><?=$var[floor]?></span></td>
							<td><span><?=$var[status]?></span></td>
							<td><span><?=$var[holder]?></span></td>
							<td><span><?=$var[resident]?></span></td>
*/

//$sql = 'SELECT a.id AS id,building,addr_no,floor,unpaid_total,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id';
$sql = 'SELECT a.id AS id,building,addr_no,floor,"1100" as unpaid_total,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);


// echo $sql;

$data = $db->getRows($sql);
session_start();

//var_dump($data);
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

<!--				
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/infrastructure.php">公共設施</a>
				</li>
-->				
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
	foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>

						<tr>
							<td><span><?=$var[building];?></span></td>
							<td><span><?=$var[addr_no];?></span></td>
							<td><span><?=$var[floor];?></span></td>
							<td><span><?=$var[status];?></span></td>
							<td><span><?=$var[holder];?></span></td>
							<td><span><?=$var[resident];?></span></td>
							<td>
								<?php 
								$sql = "SELECT SUM(fee) AS s FROM hoa_fee_record WHERE hid = $var[id] AND p IS NULL";
								//echo $sql;
								$s = $db->getRow($sql);
								$s = $s['s'];
								//echo $s;
								//if (false) {
								//if($var[unpaid_total] == 0) {
								//	echo '<span class="paid">';
							 	//} else {
								//	echo '<span class="unpaid">' . $var[unpaid_total];
								//}
								//}
								?>
								
								<span><?=number_format($s);?></span>
							</td>
<!--							
							<td>
								<span class="unpaid">未繳</span>
							</td>
-->							
							<td>
								<?php 
								if($var[unpaid_total] != 0) {
if (false) {																		
									echo '<a href="#" data-id="' . $var[id] . '" class="show-details btn btn-outline-secondary">';
									echo '顯示';
									echo '</a>';
} else {
?>

								<!-- <input id='clickMe' type='button' value='明細' onclick='doFunction(<?=$var[id];?>);' /> -->
								<a href="/smartbuilding/assets/household-fee-list.php?id=<?=$var[id];?>&floor=<?=$var[floor];?>&addr_no=<?=$var[addr_no]?>&holder=<?=$var[holder];?>" class="btn btn-outline-secondary">顯示</a> 

							<!-- <a href="/smartbuilding/assets/household-fee-list.php?id=<?=$var[id];?>" class="btn btn-outline-secondary">顯示</a> -->
<?php
}									
								}
?>
							</td>

<!--
							<td><a href="#" id="show-detailss" data-id="<?= $var[id] ?>" class="btn btn-outline-secondary">顯示</a></td>
-->


							<td><a href="/smartbuilding/assets/household-edit.php?id=<?=$var[id];?>" class="btn btn-outline-secondary">修改</a></td>




						</tr>
<?php
	}
?>


<?php
	// foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>
<!--
						<tr>
							<td><span>忠孝棟</span></td>
							<td><span>AX0001 1F樓</span></td>
							<td><span>已入住</span></td>
							<td><span>測試人員</span></td>
							<td><span>測試人員</span></td>
							<td><a href="/smartbuilding/assets/edit-page.php" class="btn btn-outline-secondary">修改</a></td>
						</tr>
						<tr>
							<td><span>仁愛棟</span></td>
							<td><span>19號 1F樓</span></td>
							<td><span>出售中</span></td>
							<td><span>測試人員</span></td>
							<td><span>測試人員</span></td>
							<td><a href="/smartbuilding/assets/edit-page.php" class="btn btn-outline-secondary">修改</a></td>
						</tr>
-->						
<?php
	// }
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


document.GetElementById('clickMe').onclick = function() {
	alert('Hello');
}


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
<?php
// $sql = "SELECT fee FROM hoa_fee_record WHERE hid=" . "<script>document.write(datalist[1][item].id)</script>";
// $data = $db->getRow($sql);
?>
			// type, fee, m

			var str = "";

// if (false) {
// 			str="<table><tr><td>{{id}}</td><td>{{addr_no}}</td><td>{{building}}</td><td>{{holder}}</td><td>{{status}}</td></tr></table>";
// } else {
			// str="<table><tr><td>{{type}}</td><td>{{fee}}</td><td>{{m}}</td></tr></table>";
			str="<tr><td>{{type}}</td><td>{{fee}}</td><td>{{m}}</td></tr>";
// }			
			//var str="<table><tr><td>{{m}}</td><td>{{type}}</td><td>{{fee}}</td></table>";
			//var str="<tr><td>{{m}}</td><td>{{type}}</td><td>{{fee}}</td>";
			//var str="<tr><td>{{m}}</td>";
			//var strParse = "<?=$data['fee'];?>";
			if(datalist[0] == 1){
				var strParse = "";
				$('.details-model').show()
// if (false) {
// 				for(var item in datalist[1]){
// 					strParse +=
// 						str.replace('{{id}}',datalist[1][item].id)
// 						.replace('{{addr_no}}',datalist[1][item].addr_no)
// 						.replace('{{building}}',datalist[1][item].building)
// 						.replace('{{holder}}',datalist[1][item].holder)
// 						.replace('{{status}}',datalist[1][item].status)
// 				}
// } else {
				for(var item in datalist[1]){
					strParse +=
						str.replace('{{type}}',datalist[1][item].type)
						.replace('{{fee}}',datalist[1][item].fee)
						.replace('{{m}}',datalist[1][item].m)
				}
// }
				//  strParse += "</table>";
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