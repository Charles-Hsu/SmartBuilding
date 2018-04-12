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
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/apartment/settings.php">規約設定</a>
                </li>					
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
$('.asset-table').on('change', '.meeting-holder', function() {
    var id = $(this).attr('id');
    var att_id=$(this).attr('att-id');
    var meeting_id=$(this).attr('meeting-id');
	var _this=$(this);
	$.ajax({
		url:'../data/meeting-attendData.php',
		method:'POST',
		data:{
            id: id,
            att_id: att_id,
            meeting_id: meeting_id,
			meeting_type: <?php echo $_GET[type] ?>
		},
		success:function(data){
			try {
				var _data = JSON.parse(data)
				
				if (_data.success){
                    _this.closest('td').html(`<span>${_data.any_data}</span>`)
                    // _data.att_rate += 1;
                    $('#assets-tab').find('.att-rate').text(_data.att_rate)
                    // location.reload()
				} else {
					alert('請重新操作')
				}
				
			} catch (error){
				alert(data)
			}
		}
	})
})
</script>

<?php include('../Footer.php'); ?>