<?php 
include('../config.php');
include(Document_root.'/Header.php'); 
?>

<?php 


if (count($_POST) > 0) {
    var_dump($_POST);
}

$sql = 'SELECT a.*, b.name AS status FROM assets a, asset_status b WHERE a.status_no = b.id';
/*
							<td><span><?=$var[building]?></span></td>
							<td><span><?=$var[addr_no]?></span></td>
							<td><span><?=$var[floor]?></span></td>
							<td><span><?=$var[status]?></span></td>
							<td><span><?=$var[holder]?></span></td>
							<td><span><?=$var[resident]?></span></td>
*/

$sql = 'SELECT SUM(fee) as total FROM hoa_fee WHERE fee_type = 1 OR fee_type = 1';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRow($sql);

var_dump($data);

$total = $data['total'];
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
					<a class="nav-link" href="/smartbuilding/assets/household.php">產權管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/sellrent.php">租售管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/smartbuilding/assets/brokerman.php">帶看管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link active" href="/smartbuilding/assets/hoa_fee.php">收管理費</a>
				</li>
			</ul>
		</div>
	</div>
</div>


<form method="POST" action = "">
    <table class="table asset-table">
        <thead class="thead-light">
						<tr>
                            <th>月份</th>
							<th>收管理費</th>
							<th>應收</th>
							<th>已收</th>
						</tr>
        </thead>
        <tbody>
<?php
$first_day_of_month = strtotime(date("Y-01-01"));
//echo date('Y-m', $next_month);
//echo date("Y");
$i = 0;
do {
    $Y_m = date('Y-m', $first_day_of_month);
?>
            <tr>
                <td><?=$Y_m?></td>
                <td><input type='checkbox' name='<?=$Y_m?>' disabled></td>
                <td><?=number_format($total);?></td>
                <td>1000</td>
            </tr>
<?php

    $first_day_of_month = strtotime('+1 month', $first_day_of_month);
    $i++;

} while ($i < 12);

?>            
        </tbody>
    </table>
    <input type="submit" value="收管理費">
</form>


<script>
/*
var moveX = 0, moveY = 0, x = 0, y = 0;
var detailsHead=document.getElementById('details-head');
var detailsModel=document.getElementById('details-model');


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

*/
</script>


<?php 
include(Document_root.'/Footer.php');
?>