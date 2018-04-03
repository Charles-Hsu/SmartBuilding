<?php 
include('../config.php');
include(Document_root.'/Header.php'); 
?>

<?php 

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

if (count($_POST) > 0) {
    //var_dump($_POST);
    foreach($_POST as $key => $value) {
        //var_dump($key);  //2018-03, 2018-04, ...
        //var_dump($value);

        //echo $key . '-01';
        $m = $key . '-01';
        $sql = "INSERT INTO hoa_fee_month_printed VALUES (NULL, '$m')";
        if ($db->insert($sql)) {
			//if ($db->insertRow($table, $data)) {
			$message="新增成功";
        }
        $sql = "SELECT * FROM hoa_fee_defined WHERE fee_type = 1 OR fee_type = 2"; // 1: 管理費, 2:停車費, 3:帶看費
        $data = $db->getRows($sql);
        foreach ($data as $val) {
            //var_dump($val);
            $sql = "INSERT INTO hoa_fee_record VALUES (NULL, " . $val["hid"] . ", " . $val["fee_type"] . ", " . $val["fee"] . ", '" . $m . "', NULL)";
            //echo $sql;
            //echo '<br>';
            if ($db->insert($sql)) {
                //if ($db->insertRow($table, $data)) {
                $message="新增成功";
            }
        }
    }
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

$sql = 'SELECT SUM(fee) as total FROM hoa_fee_defined WHERE fee_type = 1 OR fee_type = 1';


$data = $db->getRow($sql);

//var_dump($data);


$total = $data['total'];
session_start();


$sql = 'SELECT has_generated FROM hoa_fee_month_printed';
$data = $db->getRows($sql);
//var_dump($data);


$has_generated = array();

foreach ($data as $val) {
    //echo $val['has_generated'] . '<br>';
    array_push($has_generated, SUBSTR($val['has_generated'], 0, 7));
}

//var_dump($has_generated);

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
					<a class="nav-link active" href="/smartbuilding/assets/hoa_fee.php">管理費</a>
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
                            <th>未收</th>
						</tr>
        </thead>
        <tbody>
<?php
$first_day_of_month = strtotime(date("Y-01-01"));
//echo date('Y-m', $next_month);
//echo date("Y");
$i = 0;



// if (in_array('2018-01', $has_generated)) {
//     echo 'in_array';
// }


do {
    $Y_m = date('Y-m', $first_day_of_month);
    $d = '';
    if (in_array($Y_m, $has_generated)) {
        $d = 'disabled';
    }
?>
            <tr>
                <td><?=$Y_m?></td>

<?php
    if (in_array($Y_m, $has_generated)) {
?>
                <td>已產生</td>
<?php
    } else {
?>
                <td><input type='checkbox' name='<?=$Y_m?>' <?=$d;?>></td>
<?php
    }
?>                
                <td><?=number_format($total);?></td>
<?php
        $Y_m_d = date('Y-m-d', $first_day_of_month);
        $sql = "SELECT SUM(fee) AS paid FROM hoa_fee_record WHERE p IS NOT NULL AND m = '" . $Y_m_d . "'";
        $paid = 0;
        $p = $db->getRow($sql);
        $paid = $p['paid'];

        //var_dump($p);

?>                
                <td><?=number_format($paid);?></td>
                <td><?=number_format($total - $paid);?></td>
            </tr>
<?php

    $first_day_of_month = strtotime('+1 month', $first_day_of_month);
    $i++;

} while ($i < 12);

?>            
        </tbody>
    </table>
    <input type="submit" value="產生收費表單">
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