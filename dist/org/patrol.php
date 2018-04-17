<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 




if (count($_POST) > 0) {
    //var_dump($_POST);
}

//$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
$sql = 'SELECT a.staff_id,a.dt,b.name FROM `staff_work_time` a, staff b WHERE b.id = a.staff_id';

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);
/*
if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}
*/

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org.php">人員</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>

                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/mails.php">郵件紀錄</a>
                </li>
                <!-- <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li> -->
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="table-responsive-lg table-responsive-xl row">
            <table class="punch-table table table-bordered ">
                <thead>
                    <tr>
                        <th class="text-center" width="60">姓名</th>
                        <th colspan=31 class="text-center">日期</th>
                        <th class="text-center" width="60">時數</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- 姓名 -->
                        <td class="name">陳慶陽</td>

                        <!-- 日期 -->
                        <td id="checktime-td" class="checktime-td" colspan="31">
                            <div class="checktime-box d-flex justify-content-around"></div>
                        </td>

                        <!-- 時數 -->
                        <td class="totaltime">24</td>
                    </tr>
                </tbody>
            </table>
            <div class="col-6 offset-md-3 text-center">
                <div class="btn-group">
                    <button id="onwork" class="btn btn-primary" type="submit">上班</button>
                    <button id="offwork" class="btn btn-outline-primary"disabled type="submit">下班</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    var month_olympic = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var month_normal = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var my_date=new Date();
    var my_year=my_date.getFullYear();
    var my_month=my_date.getMonth();
    var my_day=my_date.getDate();
    var daysMonth;
    var str='';
    if( my_year % 4){
        daysMonth=month_olympic[my_month];
    }else{
        daysMonth=month_normal[my_month];
    }
    for(var i=1;i<=daysMonth;i++){
        str+=`<div class="checktime">${i}</div>`;
    }
    $('.checktime-box').html(str)

    // 初始化區
    $.ajax({
        url:'../data/patrolData.php',
        method:'GET',
        dataType:'JSON',
        success:function(data){
            console.log(data)
        }
    })

    $('#onwork').on('click',function(){
        var new_date=new Date();
        var new_hour=new_date.getHours();
        var new_Min=new_date.getMinutes()
        var new_Sec=new_date.getSeconds();
        var time=`${new_hour}:${new_Min}:${new_Sec}`;
        $.ajax({
            url:'../data/patrolData.php',
            method:'POST',
            dataType:'JSON',
            data:{
                year:my_year,
                month:my_month,
                day:my_day,
                time:time
            },
            success:function(data){
                if(data[0] == 'success'){
                    $('.checktime').eq(my_day-1).addClass('onwork');
                    $('#onwork').removeClass('btn-primary').addClass("btn-outline-primary").prop('disabled',true)
                    $('#offwork').addClass('btn-primary').removeClass("btn-outline-primary").prop('disabled',false)
                }
            }
        })
    })
    $('#offwork').on('click',function(){
        var new_date=new Date();
        var new_hour=new_date.getHours();
        var new_Min=new_date.getMinutes()
        var new_Sec=new_date.getSeconds();
        var time=`${new_hour}:${new_Min}:${new_Sec}`;
        $.ajax({
            url:'../data/patrolData.php',
            method:'POST',
            dataType:'JSON',
            data:{
                year:my_year,
                month:my_month,
                day:my_day,
                time:time
            },
            success:function(data){
                if(data[0] == 'success'){
                    $('.checktime').eq(my_day-1).addClass('offwork');
                    $('#offwork').addClass('btn-primary').removeClass("btn-outline-primary").prop('disabled',true)
                }
            }
        })
    })
})

</script>
<?php include('../Footer.php'); ?>