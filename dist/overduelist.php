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
    <a class="active" href="./overduelist.php">欠繳清單</a>
    <a class="" href="./opinionlist.php">住戶意見</a>
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
    <div id="assets-tab">
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
							<th>欠繳</th>
							<th>紀錄</th>
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
							<td><span><?=$var[building]?></span></td>
							<td><span><?=$var[addr_no]?></span></td>
							<td><span><?=$var[floor]?></span></td>
<!--                            
							<td><span><?=$var[status]?></span></td>
-->                            
							<td><span><?=$var[holder]?></span></td>
<!--                            
							<td><span><?=$var[resident]?></span></td>
-->                            
<td>
								<?php 
								if($var[unpaid_total] == 0) {
									echo '<span class="paid">';
							 	} else {
									echo '<span class="unpaid">' . $var[unpaid_total];
								}
								?>
								</span>
							</td>
<!--							
							<td>
								<span class="unpaid">未繳</span>
							</td>
-->							
							<td>
								<?php 
								if($var[unpaid_total] != 0) {
									echo '<a href="' . $var[id] . '" class="btn btn-outline-secondary">';
									echo '顯示';
                                    echo '</a>';
								}
								?>
							</td>
                            <!--
							<td><a href="/smartbuilding/assets/household-edit.php?id=<?=$var[id];?>" class="btn btn-outline-secondary">修改</a></td>
                            -->
                            <!--
							<td><a href="/smartbuilding/assets/sellrent-edit.php?id=<?=$var[id]?>" class="btn btn-outline-secondary">帶看設定</a></td>
                            -->
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
	"processing": true
})
</script>
<?php 
include(Document_root.'/Footer.php');
?>