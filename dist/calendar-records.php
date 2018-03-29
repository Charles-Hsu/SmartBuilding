<?php 
include('./config.php');
include('./Header.php');
?>
<?php 

$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);

if (strlen($_SESSION['account']) == 0) {
	header('Location: ' . '/smartbuilding/login.php');
}

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
        <div class="calendar-wrap">
            <div class="title">
                <div class="left">
                    <div id="month-en"></div>
                    <div id="year"></div>
                </div>
                <div id="month-num"></div>
                <i id="prev" class="fas fa-angle-left"></i>
                <i id="next" class="fas fa-angle-right"></i>
            </div>
            <div class="body">
                <div class="week-list">
                    <ul>
                        <li>星期一</li>
                        <li>星期二</li>
                        <li>星期三</li>
                        <li>星期四</li>
                        <li>星期五</li>
                        <li>星期六</li>
                        <li>星期日</li>
                    </ul>
                </div>
                <div class="days-list">
                    <ul id="days">

                    </ul>
                </div>
            </div>
        </div>
	</div>
</div>
<script>
    var month_olympic = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var month_normal = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var month_name = ["January", "Febrary", "March", "April", "May", "June", "July", "Auguest", "September", "October","November", "December"];
    var month_colors=['#8559A5','#23B1A5','#FDA403','#137083','#6B0848','#404B69','#8E1D41','#248888','#A0204C','#35B0AB','#D02E77','#0074E4']
    var my_date=new Date();
    var my_year=my_date.getFullYear();
    var my_month=my_date.getMonth();
    var my_day=my_date.getDate();
    $('#days').on('click','li',function(){
        console.log($(this).closest('.calendar-wrap').find('#year').text())
        console.log($(this).closest('.calendar-wrap').find('#month-num').text())
        console.log($(this).text())
    })
    $('#next').on('click',function(){
        my_month++;
        if(my_month > 11){
            my_month=0;
            my_year++;
        }
        refreshDate()
    })
    $('#prev').on('click',function(){
        my_month--;
        if(my_month < 0){
            my_month=11;
            my_year--;
        }
        refreshDate()
    })
    function dayStart(year,month){
        var temp=new Date(year,month,1);
        return temp.getDay();
    }
    function daysMonth(year,month){
        if( year % 4 ){
            return month_olympic[month]
        }else{
            return month_normal[month]
        }
    }
    function refreshDate(){
        var str=''
        var totalDay=daysMonth(my_year,my_month);
        var totalYear=daysMonth(my_year,my_month);
        var getDayStart=dayStart(my_year,my_month);
        var myclass;
        for(var i=1;i<getDayStart;i++){
            str+=`<li></li>`
        }
        for(var i=1;i<=totalDay;i++){
            if(i < my_day && my_year == my_date.getFullYear() && my_month == my_date.getMonth() ){
                str+=`<li><a href="javascript:;" class="gray">${i}</a></li>`
            }else if( i == my_day && my_year == my_date.getFullYear() && my_month == my_date.getMonth() ){
                str+=`<li><a class="today" href="calendar-addlist.php?year=${my_year}&month=${my_month+1}&day=${i}">${i}</a></li>`
            }else{
                str+=`<li><a class="will" href="calendar-addlist.php?year=${my_year}&month=${my_month+1}&day=${i}">${i}</a></li>`
            }
        }
        $('#days').html(str)
        $('#month-en').css('color',month_colors[my_month]).text(month_name[my_month])
        $('#month-num').text(my_month+1)
        $('#year').text(my_year)
    }
    refreshDate()
</script>
<?php include('./Footer.php'); ?>