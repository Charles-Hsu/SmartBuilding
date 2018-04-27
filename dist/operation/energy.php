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
					<a class="nav-link active" href="<?= $urlName ?>/operation/energy.php">節約能源</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation.php">例行作業</a>
				</li>
				<?php
                    if ($_isAdmin) {
                ?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <?php
					}
                ?>
			</ul>

			<div class="energy-col mb-3">
				<div class="card h-100">
					<div class="card-header">節約能源</div>
					<div class="card-body h-100">
						<canvas id="energy-chart"></canvas>
					</div>
				</div>
			</div>

			<div id="assets-tab">

				<?php
					if ($_isAdmin) {
				?>
				<a href="<?= $urlName ?>/operation/energy-new.php" class="btn add-asset-btn mb-3">
				<span>+</span>新增電費
				</a>
				<?php
					}
				?>

				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>年月</th>
							<th>電費</th>
						</tr>
					</thead>
					<?php
						$sql = "SELECT yyyymm,fee FROM elect_fee";
						// echo $sql;
						$data = $db->getRows($sql);
					?>
					<tbody>
						<?php
							foreach ($data AS $var) {
						?>
						<tr>
							<td><?php echo $var['yyyymm'];?></td>
							<td><?php echo $var['fee'];?></td>
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
var energyData=<?php echo json_encode($data) ?>;
var energyYears=[];
var energyYear=[];
var energyObj={};
var datasets=[];
for(var i=0;i<energyData.length;i++){
	energyYears.push(energyData[i].yyyymm.substr(0,4))
}
energyYears.forEach((item,index)=>{
	if(energyObj[item]){
		energyObj[item]=[];
	}else{
		energyObj[item]=[];
	}
})
energyData.forEach((item,index)=>{
	energyObj[item.yyyymm.substr(0,4)].push(item.fee)
})
for(var i=0;i<energyYears.length;i++){
	if(energyYear.indexOf(energyYears[i]) === -1){
		energyYear.push(energyYears[i])
	}
}
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
})

var colors = Chart.helpers.color;
var colorsArray=['rgba(255, 182, 185, 0.5)','rgba(250, 227, 217,0.5)','rgba(187, 222, 214,0.5)','rgba(97, 192, 191,0.5)']
for(var i=0;i<energyYear.length;i++){
	datasets.push({
		label:energyYear[i],
		data: energyObj[energyYear[i]],
		backgroundColor: colorsArray[i],
		borderColor: colorsArray[i],
		borderWidth: 1
	})
}

var energy = document.getElementById("energy-chart");
energy.height=100;
var energyCtx=energy.getContext('2d');
var energyChart = new Chart(energy, {
    type: 'bar',
    data: {
        labels: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
        datasets: datasets
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
});
</script>
<?php include('../Footer.php'); ?>