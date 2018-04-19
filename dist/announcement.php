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
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="<?= $urlName ?>/announcement.php">公告</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/opinionlist.php">住戶意見</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/overduelist.php">欠繳費用</a>
                </li>
				<?php
					if ($_isAdmin) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/kpi.php">績效指標</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/space-management.php">空間變更</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $urlName ?>/management.php">管理辦法</a>
				</li>
				<?php
					}
				?>
			</ul>
			<?php
				$sql = 'SELECT * FROM post';
				$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
				$data = $db->getRows($sql);
			?>
			<div id="assets-tab">
				<?php
					if ($_isAdmin) {
				?>
				<a href="<?= $urlName ?>/announcement-new.php" class="btn add-asset-btn mb-3">
				<span>+</span>新增公告
				</a>
				<?php
					}
				?>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>公告日期</th>
							<th>公告標題</th>
							<?php
								if ($_isAdmin) {
							?>
							<th>修改</th>
							<th>刪除</th>
							<?php
								}
							?>
						</tr>
					</thead>
					<tbody class="opinionlist_tbody">
						<?php
							foreach($data as $var) {
						?>
						<tr>
							<td class="announ-date"><span><?=$var['date'];?></span></td>
							<td class="announ-content"><input type="text" class="form-control" value="<?=$var['content'];?>" readonly></td>
							<?php
								if ($_isAdmin) {
							?>
							<td class="announ-edit" data-id="<?= $var[id] ?>"><a href="#" class="btn btn-primary btn-announEdit">編輯</a></td>
							<td class="announ-del"><a href="#" data-id="<?= $var[id] ?>" class="btn btn-danger btn-announDel">刪除</a></td>
							<?php
								}
							?>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>

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
$('.btn-announEdit').on('click',function(e){
	e.preventDefault();
	$(this).closest('tr').find('.announ-content input').prop('readonly',false);
	$(this).closest('td').html('<a href="#" class="btn btn-success btn-announSave">保存</a>')
})

$('.announ-edit').on('click','.btn-announSave',function(e){
	var _this=$(this);
	var id=_this.closest('.announ-edit').attr('data-id');
	var content=_this.closest('tr').find('.announ-content input').val();
	e.preventDefault();
	$.ajax({
		url:'./data/announcementData.php',
		method:'POST',
		data:{
			id,
			content,
			type:'PUT'
		},
		success:function(data){
			try{
				var _data=JSON.parse(data);
				if(_data.success){
					_this.closest('tr').find('.announ-content input').prop('readonly',true);
					_this.closest('tr').find('.announ-edit').html('<a href="#" class="btn btn-primary btn-announEdit">編輯</a>')
					alert('修改成功');
				}else{
					alert('請重新操作')
				}
			}catch(error){
				alert(data)
			}
		},
		error:function(error){
			console.log(error)
		}
	})
})

$('.btn-announDel').on('click',function(e){
	var id=$(this).attr('data-id');
	e.preventDefault();
	if(confirm('確定刪除??')){
		$.ajax({
			url:'./data/announcementData.php',
			method:'POST',
			data:{ id ,type:'DELETE'},
			success:function(data){
				try{
					var _data=JSON.parse(data);
					if(_data.success){
						location.reload();
					}else{
						alert('請重新操作')
					}
				}catch(error){
					alert(data)
				}
			},
			error:function(err){
				console.log(err)
			}
		})
	}else{
		return false;
	}
})
</script>
<?php include('../Footer.php'); ?>