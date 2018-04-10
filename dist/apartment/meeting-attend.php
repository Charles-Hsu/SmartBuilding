<?php 
include('../config.php');
include('../Header.php'); 
?>
<?php 
$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
session_start();
//echo "_SESSION['account'] = " . $_SESSION['account'];
//echo strlen($_SESSION['account']);
//var_dump($data);

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
					<a class="nav-link" href="<?= $urlName ?>/apartment/public-util.php">公共設施</a>
				</li>
				<li class="nav-item">
					<a class="nav-link  active" href="<?= $urlName ?>/apartment/meeting-man.php">會議管理</a>
				</li>				
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/meeting-resolution.php">決議事項</a>
				</li>								
<!--				
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/bank-acc.php">銀行專戶</a>
				</li>
-->				
			</ul>
			<div id="assets-tab">
				<a href="<?= $urlName ?>/apartment/meeting-man.php" class="btn add-asset-btn mb-3">
					<span>+</span>出席狀況
                </a>
                
<?php
$meeting_type = $_GET[type];
if ($meeting_type == 1 || $meeting_type == 2) {
    include ('meeting-attend-holder.php');
} else {
    include ('meeting-attend-committee.php');
}
?>
			</div>
		</div>
	</div>
</div>

<script>
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
	"processing": true
})
$('.meeting-holder').on('change',function(){
	var _id=$(this).attr('data-id');
	var _this=$(this);
	$.ajax({
		url:'../data/meeting-attendData.php',
		method:'POST',
		dataType:'json',
		data:{
			id:_id,
			meeting_type:1
		},
		success:function(data){
			var new_date=new Date();
			var new_hour=new_date.getHours();
			var new_Min=new_date.getMinutes()
			var new_Sec=new_date.getSeconds();
			var time=`${new_hour}:${new_Min}:${new_Sec}`;
			if(data[0] === 'success'){
				_this.closest('td').html(`<span>${data[1]}</span>`)
			}else{
				alert('請重新操作')
			}
		}
	})
})
</script>

<?php include('../Footer.php'); ?>