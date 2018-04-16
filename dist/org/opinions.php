<?php 
include('../config.php');
include('../Header.php'); 

$sql = 'SELECT a.*, b.addr_no,b.floor, c.type, a.content FROM opinions a, household b, opinion_type c WHERE b.id = a.household_id AND c.id = a.type';
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
$data = $db->getRows($sql);
session_start();
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
					<a class="nav-link" href="<?= $urlName ?>/org/patrol.php">勤務管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/contracts.php">廠商管理</a>
                </li>

                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/mails.php">郵件紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/transfer.php">移交紀錄</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/org/chart.php">管理委員會</a>
                </li>
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/org/op-add1.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增住戶意見
				</a>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>反應日期</th>
							<th>戶號</th>
							<th>樓層</th>
							<th>主旨</th>
							<th>內容</th>
							<th>回復</th>
							<th>結案</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($data as $var) {
						?>					
						<tr>
						<td><span><?=$var['dt'];?></span></td>
						<td><span><?=$var['addr_no'];?></span></td>
						<td><span><?=$var['floor'];?></span></td>
						<td><span><?=$var['type'];?></span></td>
						<td><span><?=$var['content'];?></span></td>
						<td>
							<?php
							if ($var['dt_responsed'] == NULL) {
							?>						
							<button data-id="<?=$var['id'];?>" class="btn-reply btn btn-outline-primary">確認</button>
							<?php
							} else {
								if ($var['dt_responsed'] == '0000-00-00' || $var['dt_responsed'] == NULL) {
							?>
							<span><input type='checkbox' class="btn-reply btn btn-outline-primary">></span>
							<?php
								} else {
							?>
							<span><?=$var['dt_responsed'];?></span>
							<?php		
								}
							?>
							<?php
							}
							?>					
						</td>
						<td>
							<?php
								if ($var['dt_completed'] == NULL) {
							?>
							<span><input type='checkbox' data-id="<?=$var['id'];?>" class="btn-end btn btn-outline-primary"></span>
							<?php
								} else {
							?>
							<span><?=$var['dt_completed'];?></span>
							<?php		
								}
							?>
						</td>
						<?php
						} // foreach
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
function getNowDate(){
	var now=new Date();
	var now_year=now.getFullYear();
	var now_month=now.getMonth()+1;
	var now_date=now.getDate();
	var now_Hour=now.getHours();
	var now_Min=now.getMinutes();
	var now_Sec=now.getSeconds();
	var now_array=[];
	if(now_month < 10){
		now_month='0'+now_month
	}
	if(now_date < 10){
		now_date='0'+now_date
	}
	if(now_Hour<10){
		now_Hour='0'+now_Hour
	}
	if(now_Min<10){
		now_Min='0'+now_Min
	}
	if(now_Sec<10){
		now_Sec='0'+now_Sec
	}
	var fullDate=`${now_year}-${now_month}-${now_date}`;
	var fullTime=`${now_Hour}:${now_Min}:${now_Sec}`;
	now_array=[fullDate,fullTime];
	return now_array;
}
// $('.btn-reply').on('click',function(){
$('.btn-reply').on('change', function() {

	//alert($(this).attr('data-id'));

	var _this=$(this);
	var str='';
	$.ajax({
		url:'../data/optinionsData.php',
		method:'POST',
		dataType:'JSON',
		data:{
			id:$(this).attr('data-id'),
			fulldate:getNowDate()[0],
			fulltime:getNowDate()[1],
			opinionstype:'reply'
		},
		success:function(data){
			if(data[0] == 'success'){
				str=`<span>${getNowDate()[0]}</span>`;
				_this.closest('td').html(str)
				$('.btn-end').removeClass('btn-outline-secondary').addClass('btn-outline-primary').prop('disabled',false);
			}
		}
	})
})
$('.btn-end').on('change',function(){
	var _this=$(this);
	var str='';
	$.ajax({
		url:'../data/optinionsData.php',
		method:'POST',
		dataType:'JSON',
		data:{
			id:$(this).attr('data-id'),
			fulldate:getNowDate()[0],
			fulltime:getNowDate()[1],
			opinionstype:'end'
		},
		success:function(data){
			if(data[0] == 'success'){
				str=`<span>${getNowDate()[0]}</span>`;
				_this.closest('td').html(str)
			}
		}
	})
})

$('.asset-table').DataTable({
	"language": {
		"search": "搜尋_INPUT_",
		"searchPlaceholder": "搜尋住戶意見...",
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
</script>
<?php include('../Footer.php'); ?>