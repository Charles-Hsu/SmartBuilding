<?php 
include('./config.php');
include('./Header.php'); 
?>
<!-- 內容切換區 -->
<nav class="index-nav my-3">
    <a class="active" href="./index.php">KPI</a>
    <a class="" href="./space-management.php">空間變更申請</a>
    <a class="" href="./announcement.php">公告</a>
    <a class="" href="./management.php">管理辦法</a>
</nav>
<div class="row mb-3">
    <div class="col-md-3 col-6 mt-3">
        <div class="kpiInfo-card card h-100">
            <div class="card-body d-flex align-items-center">
                <i class="d-none d-md-block fas fa-home dashboard-icon"></i>
                <div class="text-center w-100">
                    <div class="h5">社區資料</div>
                    <div class="h4">2,000</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mt-3">
        <div class="kpiInfo-card card h-100">
            <div class="card-body d-flex align-items-center">
                <i class="d-none d-md-block fas fa-home dashboard-icon"></i>
                <div class="text-center w-100">
                    <div class="h5">社區資料</div>
                    <div class="h3">2,000</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mt-3">
        <div class="kpiInfo-card card h-100">
            <div class="card-body d-flex align-items-center">
                <i class="d-none d-md-block fas fa-home dashboard-icon"></i>
                <div class="text-center w-100">
                    <div class="h5">社區資料</div>
                    <div class="h3">2,000</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mt-3">
        <div class="kpiInfo-card card h-100">
            <div class="card-body d-flex align-items-center">
                <i class="d-none d-md-block fas fa-home dashboard-icon"></i>
                <div class="text-center w-100">
                    <div class="h5">社區資料</div>
                    <div class="h3">1,000</div>
                </div>
            </div>
        </div>
    </div>
</div>
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