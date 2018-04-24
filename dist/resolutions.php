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
<nav class="index-nav my-3">
<?php
if ($_isAdmin) {
?>
    <a class="" href="./kpi.php">績效指標</a>
    <a class="" href="./space-management.php">空間變更</a>
    <a class="" href="./regulation.php">管理辦法</a>
<?php
}
?>
    <a class="" href="./announcement.php">公告</a>
    <a class="" href="./opinionlist.php">住戶意見</a>
    <a class="" href="./overduelist.php">欠繳費用</a>
</nav>

<?php

$sql = 'SELECT a.*,MONTH(a.dt) AS dt_month, b.addr_no,b.floor, a.content FROM opinions a, household b, opinion_type c WHERE b.id = a.household_id';

$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);


?>

<div class="row">
	<div class="col-6 mb-3">
        <div class="card card-chartbar">
            <div class="card-header">處理案件數</div>
            <div class="card-body">
				<canvas id="opinion-chart"></canvas>
            </div>
        </div>
	</div>
	<div class="col-6 mb-3">
        <div class="card card-chartbar">
            <div class="card-header">處理速度</div>
            <div class="card-body">
				<canvas id="opinionSpeed-chart"></canvas>
            </div>
        </div>
    </div>
</div>
<div id="assets-tab">
<?php
if ($_isAdmin) {
?>
    <a href="<?= $urlName ?>/op-add1.php" class="btn add-asset-btn mb-3">
		<span>+</span>新增住戶意見
	</a>
<?php
}
?>

    <table class="table asset-table">
        <thead class="thead-light">
            <tr>
                <th>日期</th>
                <th>戶號</th>
                <th>樓層</th>
                <!-- <th>種類</th> -->
                <th>內容</th>
                <th>回復/天數</th>
                <th>結案/天數</th>
            </tr>
        </thead>
        <tbody class="opinionlist_tbody">
        <?php
            foreach($data as $var) {
        ?>
            <tr>
            <td><span><?=$var['dt'];?></span></td>
            <td><span><?=$var['addr_no'];?></span></td>
            <td><span><?=$var['floor'];?></span></td>
            <td><span><?=$var['content'];?></span></td>
    		<td>
                <?php
                    if (strlen($var['dt_responsed']) == 0) {
                ?>
                <input type="checkbox">
                <?php
                    } else {
                        $diff = abs(strtotime($var['dt_responsed']) - strtotime($var['dt'])) / 24 / 3600 + 1;
                ?>
				<span><?php echo round($diff,2);?></span>
                <?php
                    }
                ?>
            </td>


    		<td>
                <?php
                    if (strlen($var['dt_completed']) == 0) {
                ?>
                <input type="checkbox">
                <?php
                    } else {
                        $diff = abs(strtotime($var['dt_completed']) - strtotime($var['dt'])) / 24 / 3600 + 1;
                ?>
				<span><?php echo round($diff,2);?></span>
                <?php
                    }
                ?>
            </td>
        <?php
            }
        ?>
		</tbody>
	</table>
</div>

<?php $jsData=json_encode($data); ?>

<script>
$('.opinionlist_tbody tr').each(function(i,item){
    if($(item).find('td span').hasClass('un_completed')){
        $(item).addClass('un_completed_red')
    }
})
var data = <?php echo $jsData ?>;
var tempData = {};
var fullData = []

data.forEach((item)=>{
    tempData[item.dt_month]=[]
})

for(var i=0;i<data.length;i++){
    tempData[data[i].dt_month].push(data[i])
}

for(var i=1;i<=12;i++){
    if(tempData[i] !== undefined){
        var tempObj={month:i,content:0,completed:0,responsed:0,reply:0,end:0,length:0}
        for(var j=0;j<tempData[i].length;j++){
            tempObj.month=tempData[i][j].dt_month
            var dt=new Date(tempData[i][j].dt).valueOf();
            var dt_res=new Date(tempData[i][j].dt_responsed).valueOf();

            if(tempData[i][j].dt_completed != null){
                var dt_com=new Date(tempData[i][j].dt_completed).valueOf();
                tempObj.end += ((dt_com-dt)/ 24 / 3600 / 1000)+ 1;
            }else{
                var dt_com=new Date().valueOf();
                tempObj.end += ((dt_com-dt)/ 24 / 3600 / 1000)+ 1;
            }
            tempObj.reply += ((dt_res-dt)/ 24 / 3600 / 1000)+ 1;
            tempObj.length++;
            if(tempData[i][j].dt_completed){
                tempObj.completed++
            }
            if(tempData[i][j].dt_responsed){
                tempObj.responsed++;
            }
            if(tempData[i][j].content){
                tempObj.content++;
            }
        }
        fullData.push(tempObj)
    }else{
        var tempObj={month:i,content:0,completed:0,responsed:0,reply:0,end:0,length:0}
        fullData.push(tempObj)
    }
}
var contentData=[];
var completedData=[];
var responsedData=[];
var replyData=[];
var endData=[];
for(var i=0; i<fullData.length; i++){
    contentData.push(fullData[i].content)
    completedData.push(fullData[i].completed)
    responsedData.push(fullData[i].responsed)
    if(!isNaN(fullData[i].reply/fullData[i].length)){
        replyData.push( (fullData[i].reply/fullData[i].length).toFixed(0) )
    }else{
        replyData.push(0)
    }
    if(!isNaN (fullData[i].end / fullData[i].length)){
        endData.push((fullData[i].end/fullData[i].length).toFixed(0))
    }else{
        endData.push(0)
    }
}
// console.log(tempData)
// console.log(tempData)
// console.log(fullData)
$('.asset-table').DataTable({
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋...",
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

var randomData=()=>{
    return Math.round(Math.random()*100)
}
var colorList={
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};
var colors = Chart.helpers.color;
var months=["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"];

// 處理案件數
var opinionChart = document.getElementById("opinion-chart").getContext('2d');
var myChart = new Chart(opinionChart, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: '住戶意見',
            data: contentData,
            backgroundColor: colors('rgb(54, 162, 235)').alpha(0.5).rgbString(),
            borderColor: colors('rgb(54, 162, 235)').alpha(0.5).rgbString(),
            borderWidth: 1
        },{
            label: '已回復',
            data: responsedData,
            backgroundColor: colors('rgb(255, 159, 64)').alpha(0.5).rgbString(),
            borderColor: colors('rgb(255, 159, 64)').alpha(0.5).rgbString(),
            borderWidth: 1
        },{
            label: '已結案',
            data: completedData,
            backgroundColor: colors('rgb(0, 153, 0)').alpha(0.5).rgbString(),
            borderColor: colors('rgb(255, 159, 64)').alpha(0.5).rgbString(),
            borderWidth: 1
        }]
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

// 處理案件速度
var opinionSpeedChart = document.getElementById("opinionSpeed-chart").getContext('2d');
var myChart = new Chart(opinionSpeedChart, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: '平均回復天數',
            data: replyData,
            backgroundColor: colors('rgb(54, 162, 235)').alpha(0.5).rgbString(),
            borderColor: colors('rgb(54, 162, 235)').alpha(0.5).rgbString(),
            borderWidth: 1
        },{
            label: '平均結案天數',
            data: endData,
            backgroundColor: colors('rgb(255, 159, 64)').alpha(0.5).rgbString(),
            borderColor: colors('rgb(255, 159, 64)').alpha(0.5).rgbString(),
            borderWidth: 1
        }]
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