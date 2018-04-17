<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 

$sql = 'SELECT * FROM assets';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);

$data = $db->getRows($sql);
$public_util_type=$_GET['id'];
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//	var_dump($data);
$sql="SELECT * FROM `facilities` WHERE id = $public_util_type";
$facilities_name=$db->getRow($sql);

?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
            <ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment.php">基本資料</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/building.php">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/apartment/public-util.php">公設預約</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/settings.php">參數設定</a>
                </li>			
			</ul>
			<div id="assets-tab">
				<div class="assets-create-title mb-3">
					<a href="<?= $urlName ?>/apartment/public-util.php" class="assets-create-icon fas fa-chevron-left"></a>
					<span>預約公共設施</span>
				</div>
                <form action="" method="POST" class="form-row">
                    <div class="col-12 d-flex align-items-center mb-3">
                        <div class="title mr-3"><?php echo $facilities_name['name']; ?></div>
                        <div class="date">
                            <input type="text" name="appointment-date" class="datepicker form-control" placeholder="請輸入日期...">
                        </div>
                        <button type="submit" class="btn btn-outline-primary appointment-btn ml-auto">確認</button>
                    </div>
                    <div class="col-12 appointment-box">
                        <!-- <div class="appointment-list">
                            <input type="checkbox" class="appointment_check" name="0" id="appointment_0">
                            <label for="appointment_0" class="appointment-label">
                                <div class="time">08:00-09:00</div>
                                <div class="check-wrap">
                                    <span class="check"></span>
                                    <span>已預約</span>
                                </div>
                                <div class="who"></div>
                            </label>
                        </div> -->
                    </div>
                </form>
			</div>
		</div>
    </div>
    <div class="reserve-model">
        <div class="card">
            <div class="card-header">
                <div class="title text-center">預約公共設施</div>
            </div>
            <div class="card-body">
                <input type="text" id="household-num" name="household-num" class="form-control mb-3" placeholder="填寫戶號...">
                <input type="text" id="household-floor" name="household-floor" class="form-control mb-3" placeholder="填寫樓層...">
                <button class="btn btn-primary btn-block reserve-submit">送出</button>
            </div>
        </div>
    </div>
    <div class="mask"></div>
</div>

<script>
$(function(){
    var now=new Date();
    var year=now.getFullYear();
    var month=now.getMonth()+1;
    if(month < 10){
        month='0'+month;
    }
    var nowdate=now.getDate();
    $('.datepicker').val(`${year}-${month}-${nowdate}`);
    var getDataDate=$('.datepicker').val();
    var public_util_type=<?php echo $public_util_type ?>;
    var checkArr=[];
    var checkArrTime=[];
    var reserve_time2=['09:00-10:00','10:00-11:00','11:00-12:00','12:00-13:00','13:00-14:00','14:00-15:00','15:00-16:00','16:00-17:00','17:00-18:00','18:00-19:00','19:00-20:00','20:00-21:00']
    var reserve_time=['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00']
    var tempData={};
    var str_html='';
    var str=`
        <div class="appointment-list">
            <input type="checkbox" id="{{appointment_id}}" class="appointment_check" {{has_time}}>
            <label for="{{appointment_ids}}" class="appointment-label">
                <div class="time">{{time}}</div>
                <div class="check-wrap">
                    <span class="check"></span>
                    <span>已預約</span>
                </div>
                <div class="who">{{who}}</div>
            </label>
        </div>`;
    $('.mask').on('click',function(){
        $('.mask').hide();
        $('.reserve-model').hide();
    })
    loadData(public_util_type,getDataDate,reserve_time,str,reserve_time2);
    $('.appointment-btn').on('click',function(e){
        e.preventDefault();
        checkArr=[];
        checkArrTime=[];
        $('.appointment_check').each(function(item){
            if($(this).prop('checked') == true && $(this).prop('disabled') != true){
                checkArr.push($(this).closest('.appointment-list').find('.time').text())
            }
        })
        for(var i=0;i<checkArr.length;i++){
            checkArrTime.push(checkArr[i].split('-')[0])
        }
        $('.mask').show();
        $('.reserve-model').show();
    })
    $('.reserve-submit').on('click',function(){
        var _this=$(this);
        if($('#household-num').val().length > 0 || $('#household-floor').val().length > 0){
            $.ajax({
                url:'../data/publicutil-appointmentData.php',
                method:'POST',
                data:{
                    public_util_type,
                    checkArrTime,
                    household_num:_this.closest('.card-body').find('#household-num').val(),
                    household_floor:_this.closest('.card-body').find('#household-floor').val(),
                    method_type:'update',
                    reserveDate:$('.datepicker').val()
                },
                success:function(data){
                    try{
                        var _data=JSON.parse(data);
                        if(_data.success){
                            $('.mask').hide();
                            $('.reserve-model').hide();
                            tempData={};
                            str_html='';
                            reserve_time.forEach((item)=>{
                                tempData[item]=[]
                            })
                            $('.appointment-box').html('')
                            for(var i=0;i<_data.data.length;i++){
                                if( tempData[_data.data[i].time] != undefined ){
                                    tempData[_data.data[i].time].push(_data.data[i])
                                }
                            }
                            for(var i=0;i<reserve_time.length;i++){
                                if(tempData[reserve_time[i]].length > 0){
                                    str_html+=str.replace("{{who}}",`${tempData[reserve_time[i]][0].addr_no}_${tempData[reserve_time[i]][0].floor}`)
                                            .replace("{{time}}",`${reserve_time2[i]}`)
                                            .replace("{{has_time}}",'disabled checked')
                                            .replace("{{appointment_id}}",`appointment_${i}`)
                                            .replace("{{appointment_ids}}",`appointment_${i}`)
                                }else{
                                    str_html+=str.replace("{{who}}",'')
                                            .replace("{{time}}",`${reserve_time2[i]}`)
                                            .replace("{{has_time}}",'')
                                            .replace("{{appointment_id}}",`appointment_${i}`)
                                            .replace("{{appointment_ids}}",`appointment_${i}`)
                                }
                                $('.appointment-box').html(str_html)
                            }
                        }else{
                            alert(_data.data);
                        }

                    }catch(error){
                        alert(data)
                    }
                },
                error:function(error){
                    console.log(error)
                }
            })
        }else{
            alert('請確定輸入!')
        }
    })
    $('.datepicker').on('change',function(){
        loadData(public_util_type,$(this).val(),reserve_time,str,reserve_time2);
    })
})
function loadData(public_util_type,date,reserve_time,str,reserve_time2){
    $.ajax({
        url:'../data/publicutil-appointmentData.php',
        method:'POST',
        data:{
            method_type:'get',
            public_util_type:public_util_type,
            reserveDate:date
        },
        success:function(data){
            try{
                var _data=JSON.parse(data);
                if(_data.success){
                    var tempData={};
                    var str_html='';
                    reserve_time.forEach((item)=>{
                        tempData[item]=[]
                    })
                    for(var i=0;i<_data.data.length;i++){
                        if( tempData[_data.data[i].time] != undefined ){
                            tempData[_data.data[i].time].push(_data.data[i])
                        }
                    }
                    for(var i=0;i<reserve_time.length;i++){
                        if(tempData[reserve_time[i]].length > 0){
                            str_html+=str.replace("{{who}}",`${tempData[reserve_time[i]][0].addr_no}_${tempData[reserve_time[i]][0].floor}`)
                                    .replace("{{time}}",`${reserve_time2[i]}`)
                                    .replace("{{has_time}}",'disabled checked')
                                    .replace("{{appointment_id}}",`appointment_${i}`)
                                    .replace("{{appointment_ids}}",`appointment_${i}`)
                        }else{
                            str_html+=str.replace("{{who}}",'')
                                    .replace("{{time}}",`${reserve_time2[i]}`)
                                    .replace("{{has_time}}",'')
                                    .replace("{{appointment_id}}",`appointment_${i}`)
                                    .replace("{{appointment_ids}}",`appointment_${i}`)
                        }
                        $('.appointment-box').html(str_html)
                    }
                }else{
                    alert(_data.data);
                }
            }catch(error){
                console.log(data)
            }
        },
        error:function(error){
            console.log(error)
        }
    })
}
</script>
<?php 
include(Document_root.'/Footer.php');
?>