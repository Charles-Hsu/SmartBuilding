<?php 
include('./config.php');
include('./Header.php'); 
?>
<?php 
//$sql = 'SELECT a.*, b.name FROM assets a, asset_status b WHERE a.status_no = b.id AND asset_no = "' . $asset_no . '"';
$sql = 'SELECT a.id AS id,building,addr_no,floor,unpaid_total,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id AND a.unpaid_total != 0';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);

if (strlen($_SESSION['account']) == 0) {
	echo 
	'<script>
		//document.onkeypress=function(e) {
			//alert("You pressed a key inside the input field");
			//document.getElementById("demo").innerHTML = 5 + 6;
			//window.location.href = "http://stackoverflow.com";



			//window.location.href = "./login.php";


		//}
	</script>';
}

?>
<!-- 內容切換區 -->
<nav class="index-nav my-3">
    <a class="" href="./kpi.php">KPI</a>
    <a class="" href="./space-management.php">空間變更</a>
    <a class="" href="./announcement.php">公告</a>
    <a class="" href="./management.php">管理辦法</a>
    <a class="" href="./overduelist.php">欠繳清單</a>
    <a class="active" href="./opinionlist.php">住戶意見</a>
</nav>

<?php 

//$sql = 'SELECT a.*, b.addr_no,b.floor FROM opinions a, household b WHERE a.id = b.id AND a.dt_completed = "0000-00-00"';

$sql = 'SELECT a.*, b.addr_no,b.floor, c.type, a.content FROM opinions a, household b, opinion_type c WHERE b.id = a.household_id AND c.id = a.type';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);


session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);
/*
if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}
*/
?>
<p>呈現總幹事的效率</p>
<p>本月已處理件數:<span>32</span></p>
<p>本月待處理件數:<span>1</span></p>
<p>平均處理天數:<span>3.5</span></p>

			<div id="assets-tab">

				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>反應日期</th>
							<th>戶號</th>
							<th>樓層</th>
							<th>主旨</th>
							<th>內容</th>
							<th>回復</th>
							<th>回復天數</th>

							<!--							
							<th>結案日</th>
-->							
							<th>結案</th>
							<th>處理天數</th>
						</tr>
					</thead>
					<tbody>

<?php
foreach($data as $var) {
	//var_dump($var);

?>					
						<tr>
						<td><span><?=$var['dt'];?></span></td>
						<td><span><?=$var['addr_no'];?></span></td>
						<td><span><?=$var['floor'];?></span></td>
						<td><span><?=$var['type'];?></span></td>
						<td><span><?=$var['content'];?></span></td>

<?php
/*
$completed = 0;
if ($var['dt_completed'] == '0000-00-00') {
	echo '';
} else {
	$completed = 1;
	echo $var['dt_completed'];
}
*/
?>

						<td>
							
<?php
if ($var['dt_responsed'] == '0000-00-00') {
?>						
							<a href="<?=$urlName;?>/org/op-edit.php?id=<?=$var['id'];?>" class="btn btn-outline-secondary">確認
							</a>
<?php
} else {
?>
							<span><?=$var['dt_responsed'];?></span>
<?php
}
?>					
					
					
						</td>


						<td>
							
<?php
if ($var['dt_responsed'] == '0000-00-00') {
?>						
							<span>未回復</span>
<?php
} else {

	$diff = abs(strtotime($var['dt_responsed']) - strtotime($var['dt'])) / 24 / 3600 + 1;
?>
							<span><?=$diff;?></span>
<?php
}
?>					
						</td>

						<td>
							
							<?php
							if ($var['dt_completed'] != '0000-00-00') {
								$dt_completed = strtotime($var['dt_completed']);
							
							?>
														<span><?=$var['dt_completed'];?></span>
							<?php
							} 
							?>					
													</td>

						<td>
							
<?php
$dt_completed = strtotime(date('Y-m-d'));
if ($var['dt_completed'] != '0000-00-00') {
	$dt_completed = strtotime($var['dt_completed']);
} else {
}
$diff = abs($dt_completed - strtotime($var['dt'])) / 24 / 3600 + 1;
?>
							<span><?=$diff;?></span>
<?php

?>					
						</td>
						

						<!-- <td><a href="<?=$urlName;?>/org/op-edit.php?id=<?=$var['id'];?>" class="btn btn-outline-secondary">結案</a></td>
						</tr> -->
<?php

?>

<?php

}
?>

					</tbody>
				</table>

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
	"processing": true,
    "order": [[0, 'desc']],
    //"order": [[0, 'asc']],
})
</script>
<?php include('../Footer.php'); ?>