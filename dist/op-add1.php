<?php session_start(); ?>
<?php 
include('./config.php');
include('./Header.php'); 
$_isAdmin = $_SESSION['admin'];
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

?>
<!-- 內容切換區 -->
<nav class="index-nav my-3">
<?php
if ($_isAdmin) {
?>
    <a class="" href="./kpi.php">績效指標</a>
    <a class="" href="./space-management.php">空間變更</a>
    <a class="" href="./announcement.php">公告</a>
    <a class="" href="./management.php">管理辦法</a>
<?php
}
?>    
    <a class="" href="./overduelist.php">欠繳清單</a>
    <a class="active" href="./opinionlist.php">住戶意見</a>
    <a class="" href="./resolutions.php">決議事項</a>
</nav>
<div id="assets-tab">
	<div class="assets-create-title mb-3">
		<a href="<?= $urlName ?>/opinionlist.php" class="assets-create-icon fas fa-chevron-left"></a>
		<span>新增住戶意見 (選擇住戶)</span>
	</div>
	<div class="row justify-content-lg-start justify-content-center">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-12">
			<table class="table asset-table">
				<thead class="thead-light">
					<tr>
						<th>大樓</th>
						<th>戶號</th>
						<th>樓層</th>
						<th>區權人</th>
						<th>現住戶</th>
						<th>反應意見</th>
					</tr>
				</thead>
				<tbody>
<?php 
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
$sql = 'SELECT a.id AS id,building,addr_no,floor,"1100" as unpaid_total,b.name AS status,holder,resident,sellrent FROM household a, household_status b WHERE a.status = b.id';
$data = $db->getRows($sql);
foreach($data as $var) {
?>
						<tr>
							<td><span><?php echo $var[building];?></span></td>
							<td><span><?php echo $var[addr_no];?></span></td>
							<td><span><?php echo $var[floor];?></span></td>
							<td><span><?php echo $var[holder];?></span></td>
							<td><span><?php echo $var[resident];?></span></td>
							</td>
							<td><a href="op-add2.php?id=<?php echo $var[id];?>" class="btn btn-outline-secondary">意見內容</a></td>
						</tr>
<?php
}
?>
					</tbody>
				</table>


<script>
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
	"order": [[0, 'desc']],
})
</script>				