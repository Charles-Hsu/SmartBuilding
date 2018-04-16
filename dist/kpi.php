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
    <a class="active" href="./kpi.php">績效指標</a>
    <a class="" href="./space-management.php">空間變更</a>
    <a class="" href="./management.php">管理辦法</a>
    <a class="" href="./announcement.php">公告</a>
<?php
}
?>    
    <a class="" href="./overduelist.php">欠繳清單</a>
    <a class="" href="./opinionlist.php">住戶意見</a>
    <a class="" href="./resolutions.php">決議事項</a>
</nav>

<?php
    $sql = "SELECT * FROM apartment_settings";
    $data = $db->getRow($sql);
?>

<table>
<tbody>
    <tr>
        <th><b>會議召開及執行率</b></th>
    </tr>
    <tr>
        <td>區權會</td>
    </tr>
    <tr>
        <td>1. 召開次數÷ 規約規定次數 (<?php echo $data['holder_meeting_num']; ?>) </td>
    </tr>
    <tr>
        <td>2. 執行記錄÷ 會議記錄事項</td>
    </tr>
    <tr>
        <td>管委會</td>
    </tr>
    <tr>
        <td>1. 召開次數÷ 規約規定次數 (<?php echo $data['committee_meeting_num']; ?>)</td>
    </tr>
    <tr>
        <td>2. 執行記錄÷ 會議記錄事項</td>
    </tr>
</tbody>

</table>

<table>
    <thead>
    <tr>
        <th><b>保全員教育訓練達成率</b></th>
    </tr>
    </thead>
<tbody>
    <tr>
        <td>1. 護照人數÷ 在職人數</td>
    </tr>
    <tr>
        <td>2. 受訓人數÷ 在職人數</td>
    </tr>
</tbody>
</table>

<table>
    <thead>
    <tr>
        <th><b>派駐人員合格率</b></th>
    </tr>
    </thead>
<tbody>
    <tr>
        <td>1. 現場主管合格人數÷ 編制人數 (<?php echo $data['op_man_num']; ?>)</td>
    </tr>
    <tr>
        <td>2. 保全員合格人數÷ 編制人數 (<?php echo $data['op_patrol_num']; ?>)</td>
    </tr>
</tbody>
</table>

<table>
    <thead>
    <tr>
        <th><b>掛號信正確執行率</b></th>
    </tr>
    </thead>
<tbody>
    <tr>
        <td>1. 登錄件數 ÷ 郵局送達清冊件數</td>
    </tr>
    <tr>
        <td>2. 遺失件數 ÷ 郵局送達清冊件數</td>
    </tr>
</tbody>
</table>


<table>
<tbody>
    <tr>
        <th><b>住戶費用率</b></th>
    </tr>
    <tr>
        <td>住戶管理費繳交達成率</td>
    </tr>
    <tr>
        <td>1. 每期繳交管理費戶數÷ 總戶數</td>
    </tr>
    <tr>
        <td>2. 實收÷ 應收</td>
    </tr>
    <tr>
        <td>住戶裝潢保證收繳率</td>
    </tr>
    <tr>
        <td>繳交保證金戶數÷ 裝潢戶數</td>
    </tr>
</tbody>
</table>


<table>
    <thead>
    <tr>
        <th><b>管理服務中心的總體滿意度</b></th>
    </tr>
    </thead>
<tbody>
    <tr>
        <td>統計回收問卷之分數總和 ÷ 份數 = 平均滿意度</td>
    </tr>
</tbody>
</table>

<table>
    <thead>
    <tr>
        <th><b>住戶交辦事項執行率</b></th>
    </tr>
    </thead>
<tbody>
    <tr>
        <td>回復件數 ÷ 登錄件數</td>

    </tr>
    <tr>
        <td>完成件數 ÷ 登錄件數</td>
    </tr>
</tbody>
</table>

<?php
$sql = 'SELECT COUNT(*) as total FROM opinions';
$data = $db->getRow($sql);
$total = $data['total'];
$sql = "SELECT count(*) AS completed FROM `opinions` WHERE dt_completed <> '0000-00-00'";
$data = $db->getRow($sql);
$completed = $data['completed'];



//$completed = $data['completed'];

echo 'total = ' . $total . '<br>';
echo 'completed = ' . $completed . '<br>';

?>


<table>
    <thead>
    <tr>
        <th><b>公有財產之登錄</b></th>
    </tr>
    </thead>
<tbody>
    <tr>
        <td>回復件數 ÷ 登錄件數</td>
    </tr>
    <tr>
        <td>完成件數 ÷ 登錄件數</td>
    </tr>
</tbody>
</table>


<div class="row mb-3">
    <div class="col-12">
        <div class="card card-chartbar">
            <div class="card-header">維運管理</div>
            <div class="card-body">
                <canvas id="smartbuild-charts"></canvas>
            </div>
        </div>
    </div>
</div>



<div class="row mb-3">
    <div class="col-lg-8 col-12">
        <div class="card card-chartbar">
            <div class="card-header">維運管理</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-12 h-100">
                        <canvas id="asset-chart"></canvas>
                    </div>
                    <div class="col-lg-4 text-center d-lg-flex d-none flex-column justify-content-center">
                        <div class="chartbar-infobox">
                            <div class="chart-sub-number">1,200</div>
                            <div class="chart-sub-title">例行作業</div>
                        </div>
                        <div class="chartbar-infobox">
                            <div class="chart-sub-number">1,200</div>
                            <div class="chart-sub-title">例行作業</div>
                        </div>
                        <div class="chartbar-infobox">
                            <div class="chart-sub-number">1,200</div>
                            <div class="chart-sub-title">例行作業</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="card h-100">
            <div class="card-header">社區股臉</div>
            <div class="card-body h-100">
                <div class="bbbbb"><canvas id="apartment-chart"></canvas></div>
            </di>
        </div>
    </div>
</div>
<script>
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
// 图表一
var smartbuild = document.getElementById("smartbuild-charts");
smartbuild.height=100;
var smartbuildCtx = smartbuild.getContext('2d');
var myLineChart = new Chart(smartbuildCtx,{
    type: "line",
    data: {
        labels: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
        datasets: [{
            label: "Sessions",
            lineTension: .5,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "red",
            pointHitRadius: 20,
            pointBorderWidth: 2,
            data: [randomData(), randomData(), randomData(), randomData(), randomData(), randomData(), randomData(), randomData(), randomData(), randomData(), randomData(), randomData(), randomData()]
        }]
    },
    options: {
        responsive: true,
        legend: {
            display: !1
        }
    }
})
// 圖表2
var asset = document.getElementById("asset-chart").getContext('2d');
var myChart = new Chart(asset, {
    type: 'bar',
    data: {
        labels: ["AA", "BB", "CC", "DD", "EE", "FF"],
        datasets: [{
            label: '# of Votes',
            data: [
                randomData(), 
                randomData(), 
                randomData(), 
                randomData(), 
                randomData(),
                randomData(),
            ],
            backgroundColor: colors('rgb(54, 162, 235)').alpha(0.5).rgbString(),
            borderColor: colors('rgb(54, 162, 235)').alpha(0.5).rgbString(),
            borderWidth: 1
        },{
            label: '# of Votes',
            data: [
                randomData(), 
                randomData(), 
                randomData(), 
                randomData(), 
                randomData(),
                randomData(),
            ],
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

// 圖表3
var apartment = document.getElementById("apartment-chart");
apartment.height=200;
var apartmentCtx=apartment.getContext('2d');
var myPieChart = new Chart(apartment,{
    type: 'pie',
    data: {
        labels:["AA","BB","CC","DD"],
        datasets:[{
            data:[randomData(),randomData(),randomData(),randomData()],
            backgroundColor:[
                colorList.red,
                colorList.orange,
                colorList.yellow,
                colorList.green,
                colorList.blue,
                colorList.purple,
            ]
        }]
    },
    options: {
        responsive: true,
    }
});

</script>
<?php include('./Footer.php'); ?>