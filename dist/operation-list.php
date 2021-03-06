<?php session_start(); ?>
<?php
	include('./config.php');
	include('./Header.php');
	if (!$_SESSION['online']) {
		$url = "./login.php";
		header("Location: " . $url);
	}
	$_isAdmin = $_SESSION['admin'];
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
?>
<?php



$curmonth = $_GET['month'];
$curyear = $_GET['year'];
$curday=$_GET['day'];

echo $curmonth;
echo $curyear;

$sql = 'SELECT a.id AS task_id, a.dt AS dt, a.descript, b.item, c.name FROM tasks a, contract_item b, contract c WHERE a.category_id = b.id AND a.contract_id = c.id AND MONTH(a.dt) = ' . $curmonth . ' AND YEAR(a.dt) = ' . $curyear . ' AND DAY(a.dt) ='.$curday;

echo $sql;
//$data = $db->getRows($sql);
//session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);
/*
if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}
*/
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
			<!--
				<a href="<?= $urlName ?>/calendar-addlist.php" class="btn add-asset-btn mb-3">
			-->
				<a href="<?= $urlName ?>/calendar-addlist.php?year=<?= $curyear ?>&month=<?= $curmonth ?>&day=<?= $curday ?>" class="btn add-asset-btn mb-3">
					<span>+</span>新增例行作業
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th></th>
							<th>作業項目</th>
							<th>作業類別</th>
<!--
							<th>作業週期</th>
-->
							<th>承包廠商</th>
							<th>作業金額</th>
							<th>修改</th>
						</tr>
					</thead>
					<tbody>
<?php

//$curdate  = CURDATE();




$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);


$data = $db->getRows($sql);
//var_dump($data);
//session_start();


foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>
						<tr>
							<td>
								<div class="check_label">
									<input type="checkbox" id="check_<?=$var['task_id']?>" name="check_<?=$var['task_id']?>" class="check_input">
									<label for="check_<?=$var['task_id']?>"></label>
								</div>
							</td>
							<td><span><?=$var['dt'];?></span></td>
							<td><span><?=$var['item'];?></span></td>
							<td><span><?=$var['name'];?></span></td>
							<td><span><?=$var['descript'];?></span></td>
							<td><a href="<?= $urlName ?>/operation/task-edit.php?id=<?=$var['task_id'];?>" class="btn btn-outline-secondary">修改</a></td>
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
<div class="modal fade" id="checkModal" data-type="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mx-auto" id="exampleModalLabel">確認完成??</h5>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button> -->
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-cancel btn-secondary" data-dismiss="modal">取消</button>
				<button type="button" id="btn-send" class="btn btn-primary">送出</button>
			</div>
		</div>
	</div>
</div>
<script>
$('.check_input').on('change',function(){
	$('#checkModal').modal('show')
	var _type=$(this).attr('name');
	$('#checkModal').attr('data-type',_type)

})
$('.btn-cancel').on('click',function(){
	var _type=$(this).closest('#checkModal').attr('data-type');
	$('.check_input').each(function(index,item){
		if($(item).attr('name') == _type){
			$(item).prop('checked',false)
		}
	})
})
$('#btn-send').on('click',function(){
	var _type=$(this).closest('#checkModal').attr('data-type');
	$.ajax({
		url:'<?= $urlName ?>/data/operationData.php',
		method:'POST',
		data:{
			id:parseFloat(_type.split('_')[1])
		},
		success:function(data){
			var _data=JSON.parse(data);
			if(_data.info === 'success'){
				location.reload();
			}else{
				alert('error')
			}

		},
		error:function(){

		}
	})
})
$('.asset-table').DataTable({
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋作業項目...",
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
	//"ordering": false,
	"ordering": true,
	"order": [[1, 'asc']],
})
</script>
<?php include('./Footer.php'); ?>