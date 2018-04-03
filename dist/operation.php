<?php 
include('./config.php');
include('./Header.php'); 
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/operation.php">例行作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/repairs-normal.php">維護作業</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/supplies.php">耗材管理</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/operation/budget.php">年度預算</a>
                </li>
			</ul>
			<div id="assets-tab">
				<div class="row">

					<div class="col-12 p-4">
						<div class="calendar-wrap">
							<div class="title">
								<div class="left">
									<i id="prev" class="mr-5 fas fa-angle-left"></i>
									<span id="year"></span>
									<span class="mx-3">年</span>
									<span id="month-num"></span>
									<span class="ml-3">月</span>
									<i id="next" class="ml-5 fas fa-angle-right"></i>
								</div>
								
								
							</div>
							<div class="body">
								<div class="week-list">
									<ul>
										<li class="holiday">星期日</li>
										<li>星期一</li>
										<li>星期二</li>
										<li>星期三</li>
										<li>星期四</li>
										<li>星期五</li>
										<li class="holiday">星期六</li>
									</ul>
								</div>
								<div class="days-list">
									<ul id="days"></ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$.ajax({
		url:'./data/operationData.php',
		method:'GET',
		dataType:'JSON',
		success:function(data){
			var tempData={};
			data.forEach((item,index)=>{
				tempData[item.dt_day]=[];
			})
			for(var i=0;i<data.length;i++){
				for(var j in tempData){
					if(j == data[i].dt_day){
						tempData[j].push(data[i])
					}
				}
			}
			for(var i=0;i<$('#days li').length;i++){
				for(var j in tempData){
					if(j == $('#days li').eq(i).attr('data-day')){
						if(tempData[j].length > 3){
							for(var k=0;k<3;k++){
								$('#days li').eq(i).find('a .task-box').append(`<span class="task">${tempData[j][k].descript}</span>`)
							}
							$('#days li').eq(i).find('a').append(`<span class="task-length">還有 ${tempData[j].length - 3} 個 待辦例行作業</span>`)
						}else{
							for(var k=0;k<tempData[j].length;k++){
								$('#days li').eq(i).find('a .task-box').append(`<span class="task">${tempData[j][k].descript}</span>`)
							}
						}
					}
				}
			}
		},
		error:function(){
			console.log('error')
		}
	})
    $('#back').on('click',function(){
        window.history.go(-1)
    })
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
		$.ajax({
			url:'./data/operationData.php',
			method:'POST',
			dataType:'JSON',
			data:{
				year:my_year,
				month:my_month+1
			},
			success:function(data){
				var tempData={};
				data.forEach((item,index)=>{
					tempData[item.dt_day]=[];
				})
				for(var i=0;i<data.length;i++){
					for(var j in tempData){
						if(j == data[i].dt_day){
							tempData[j].push(data[i])
						}
					}
				}
				for(var i=0;i<$('#days li').length;i++){
					for(var j in tempData){
						if(j == $('#days li').eq(i).attr('data-day')){
							if(tempData[j].length > 3){
								for(var k=0;k<3;k++){
									$('#days li').eq(i).find('a .task-box').append(`<span class="task">${tempData[j][k].descript}</span>`)
								}
								$('#days li').eq(i).find('a').append(`<span class="task-length">還有 ${tempData[j].length - 3} 個 待辦例行作業</span>`)
							}else{
								for(var k=0;k<tempData[j].length;k++){
									$('#days li').eq(i).find('a .task-box').append(`<span class="task">${tempData[j][k].descript}</span>`)
								}
							}
						}
					}
				}
			},
			error:function(){
				console.log('error')
			}
		})
    })
    $('#prev').on('click',function(){
        my_month--;
        if(my_month < 0){
            my_month=11;
            my_year--;
        }
        refreshDate()
		$.ajax({
			url:'./data/operationData.php',
			method:'POST',
			dataType:'JSON',
			data:{
				year:my_year,
				month:my_month+1
			},
			success:function(data){
				var tempData={};
				data.forEach((item,index)=>{
					tempData[item.dt_day]=[];
				})
				for(var i=0;i<data.length;i++){
					for(var j in tempData){
						if(j == data[i].dt_day){
							tempData[j].push(data[i])
						}
					}
				}
				for(var i=0;i<$('#days li').length;i++){
					for(var j in tempData){
						if(j == $('#days li').eq(i).attr('data-day')){
							if(tempData[j].length > 3){
								for(var k=0;k<3;k++){
									$('#days li').eq(i).find('a .task-box').append(`<span class="task">${tempData[j][k].descript}</span>`)
								}
								$('#days li').eq(i).find('a').append(`<span class="task-length">還有 ${tempData[j].length - 3} 個 待辦例行作業</span>`)
							}else{
								for(var k=0;k<tempData[j].length;k++){
									$('#days li').eq(i).find('a .task-box').append(`<span class="task">${tempData[j][k].descript}</span>`)
								}
							}
						}
					}
				}
			},
			error:function(){
				console.log('error')
			}
		})
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
		var getDayEnd=new Date(my_year,my_month,totalDay).getDay();
        var myclass;
        for(var i=1;i<getDayStart;i++){
            str+=`<li class="d-flex flex-column"></li>`
        }
        for(var i=1;i<=totalDay;i++){
            if(i < my_day && my_year == my_date.getFullYear() && my_month == my_date.getMonth() ){
                str+=
					`<li class="${i}" data-day="${i}">
						<a href="operation-list.php?year=${my_year}&month=${my_month+1}&day=${i}" class="d-flex flex-column gray">
							<span>${i}</span>
							<div class="task-box d-flex flex-column"></div>
						</a>
					</li>
					`;
            }else if( i == my_day && my_year == my_date.getFullYear() && my_month == my_date.getMonth() ){
                str+=
					`<li class="${i}" data-day="${i}">
						<a href="operation-list.php?year=${my_year}&month=${my_month+1}&day=${i}" class="today d-flex flex-column">
							<span>${i}</span>
							<div class="task-box d-flex flex-column"></div>
						</a>
					</li>`;
            }else{
                str+=
					`<li class="${i}" data-day="${i}">
						<a href="operation-list.php?year=${my_year}&month=${my_month+1}&day=${i}" class="will d-flex flex-column will">
							<span>${i}</span>
							<div class="task-box d-flex flex-column"></div>
						</a>
					</li>`;
            }
        }
		if(getDayEnd < 6){
			var endDay=6-getDayEnd;
			for(var i=1;i<=endDay;i++){
				str+=`<li></li>`
			}
		}
        $('#days').html(str)
        // $('#month-en').css('color',month_colors[my_month]).text(month_name[my_month])
        $('#month-num').text(my_month+1)
        $('#year').text(my_year)
    }
    refreshDate()
</script>
<?php include('./Footer.php'); ?>