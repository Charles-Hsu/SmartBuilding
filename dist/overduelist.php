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
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/announcement.php">公告</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/opinionlist.php">住戶意見</a>
                </li>
                <li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/overduelist.php">欠繳費用</a>
                </li>
				<?php
					if ($_isAdmin) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/kpi.php">績效指標</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/space-management.php">空間變更</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/management.php">管理辦法</a>
				</li>
				<?php
					}
				?>
			</ul>
			<?php
				$sql = 'SELECT a.*,MONTH(a.dt) AS dt_month, b.addr_no,b.floor, a.content FROM opinions a, household b, opinion_type c WHERE b.id = a.household_id';
				$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
				$data = $db->getRows($sql);
			?>
			<div class="row">
				<div class="col-6 mb-3">
					<div class="card card-chartbar">
						<div class="card-header">應繳已繳 (每月)</div>
						<div class="card-body">
							<canvas id="overdue-bar-chart"></canvas>
						</div>
					</div>
				</div>
				<div class="col-6 mb-3">
					<div class="card card-chartbar">
						<div class="card-header">已繳未繳 (比例)</div>
						<div class="card-body">
							<canvas id="overdue-pi-chart"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div id="assets-tab" class="w-100">
					<table class="table asset-table">
						<thead class="thead-light">
							<tr>
								<th>大樓</th>
								<th>戶號</th>
								<th>樓層</th>
								<th>區權人</th>
								<th>欠繳總額</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT SUM(fee) AS overdue_total FROM hoa_fee_record WHERE YEAR(m) = YEAR(CURDATE()) AND p IS NULL";
								$data = $db->getRow($sql);
								$overdue_total = $data['overdue_total'];

								$sql = "SELECT SUM(fee) AS paid_fee_total FROM hoa_fee_record WHERE YEAR(m) = YEAR(CURDATE()) AND p IS NOT NULL";
								$data = $db->getRow($sql);
								$paid_fee_total = $data['paid_fee_total'];
								// 每月已繳總計 for 應繳已繳(每月) 的 bar chart 用的資料
								$fee_per_month = (intval($overdue_total) + intval($paid_fee_total)) / intval(date('m'));
								$sql = "SELECT m,MONTH(m) as month ,SUM(fee) AS paid_fee FROM hoa_fee_record WHERE YEAR(m) = YEAR(CURDATE()) AND p IS NOT NULL GROUP BY MONTH(m)";
								$paid_fee_per_month = $db->getRows($sql);
								$sql = "SELECT SUM(a.fee) AS unpaid_total, a.hid, c.addr_no, c.floor, c.holder, c.building FROM hoa_fee_record a, household c WHERE c.id = a.hid group by a.hid, c.addr_no, c.floor, c.holder, c.building";
								$data = $db->getRows($sql);
								foreach($data as $var) {
							?>
							<tr>
								<td><span><?=$var[building]?></span></td>
								<td><span><?=$var[addr_no]?></span></td>
								<td><span><?=$var[floor]?></span></td>
								<td><span><?=$var[holder]?></span></td>
								<td><span><?=number_format($var[unpaid_total])?></span></td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<?php $paid_fee_per_month_data=json_encode($paid_fee_per_month); ?>
		</div>
	</div>
</div>

<script>
var fee_per_month=<?php echo $fee_per_month ?>;
var fee_per_monthArray=[];
var paid_fee_per_monthData=<?php echo $paid_fee_per_month_data ?>;
var paid_fee_per_monthDataObj=[];
var paid_fee_per_monthArray=[];
for(var i=0;i<12;i++){
	paid_fee_per_monthDataObj[i]={paid_fee:0};
}

paid_fee_per_monthData.forEach((item)=>{
	paid_fee_per_monthDataObj[item.month-1].paid_fee+=parseInt(item.paid_fee);
})


paid_fee_per_monthDataObj.forEach((item)=>{
	paid_fee_per_monthArray.push(item.paid_fee)
})


for(var i=0;i<paid_fee_per_monthData.length;i++){
	fee_per_monthArray.push(fee_per_month);
}

var randomData=()=>{
    return Math.round(Math.random()*100)
}

var overdueTotal=()=>{
	return <?php echo $overdue_total; ?>
}

var paidFeeTotal=()=>{
	return <?php echo $paid_fee_total; ?>
}

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

var colorList={
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};

// 應繳已繳(每月)
var colors = Chart.helpers.color;
var months=["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"];
var overdueBarChart=document.getElementById('overdue-bar-chart');
var overdueBarChartCtx=overdueBarChart.getContext('2d');
var myBarCahrt=new Chart(overdueBarChart,{
	type:'bar',
	data:{
		labels:months,
		datasets:[{
				label:"應收",
				data:fee_per_monthArray,
				backgroundColor: colors('rgb(54, 162, 235)').alpha(0.5).rgbString(),
				borderColor: colors('rgb(54, 162, 235)').alpha(0.5).rgbString(),
				borderWidth: 1
			},{
				label:"已收",
				data:paid_fee_per_monthArray,
				backgroundColor: colors('rgb(255, 159, 64)').alpha(0.5).rgbString(),
				borderColor: colors('rgb(255, 159, 64)').alpha(0.5).rgbString(),
				borderWidth: 1
			}
		]
	},
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
})

// 已繳未繳
var apartment = document.getElementById("overdue-pi-chart");
apartment.height=150;
var apartmentCtx=apartment.getContext('2d');
var myPieChart = new Chart(apartment,{
    type: 'pie',
    data: {
        labels:["已繳","未繳"],
        datasets:[{
            data:[paidFeeTotal(),overdueTotal()],
            backgroundColor:[
                colorList.green,
                colorList.red,
            ]
        }]
    },
    options: {
        responsive: true,
    }
});
</script>
<?php
include(Document_root.'/Footer.php');
?>