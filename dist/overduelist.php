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
    <a class="" href="./management.php">管理辦法</a>
<?php
}
?>    
    <a class="" href="./announcement.php">公告</a>
    <a class="" href="./opinionlist.php">住戶意見</a>
    <a class="active" href="./overduelist.php">欠繳清單</a>
    <a class="" href="./resolutions.php">決議事項</a>
</nav>

<div class="row">
<!--
    <div class="col-12 pt-4 pl-4">
        <div class="assets-create-title">
            <a href="<?= $urlName ?>/index.php" class="assets-create-icon fas fa-chevron-left"></a>
            <span>回首頁</span>
        </div>
    </div>
-->    
    <div id="assets-tab" class="w-100">
<!--            
				<a href="/smartbuilding/assets/household-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增租售案件
				</a>
-->                
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>大樓</th>
							<th>戶號</th>
							<th>樓層</th>
<!--                            
							<th>住戶狀態</th>
-->                            
							<th>區權人</th>
<!--                            
							<th>現住戶</th>
-->                            
							<th>欠繳總額</th>
							<!-- <th>明細</th> -->
						</tr>
					</thead>
					<tbody>
<?php
	$sql = "SELECT SUM(a.fee) AS unpaid_total, a.hid, c.addr_no, c.floor, c.holder, c.building FROM hoa_fee_record a, household c WHERE c.id = a.hid group by a.hid, c.addr_no, c.floor, c.holder, c.building";
	$data = $db->getRows($sql);
	foreach($data as $var) {
//		echo $var[asset_no];
//		echo $var[asset_name];
//		echo $var[status];
//		echo $var[price];
//		echo '<br>';
?>

						<tr>
							<td><span><?=$var[building]?></span></td>
							<td><span><?=$var[addr_no]?></span></td>
							<td><span><?=$var[floor]?></span></td>
							<td><span><?=$var[holder]?></span></td>
							<td><span><?=number_format($var[unpaid_total])?></span></td>
							<!-- <td><span><a href='#'>清單</a></span></td> -->
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
	"order": [[4, 'desc']],
})
</script>
<?php 
include(Document_root.'/Footer.php');
?>