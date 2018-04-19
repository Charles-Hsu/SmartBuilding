<?php session_start(); ?>
<?php
	include('../config.php');
	include('../Header.php');

	if (!$_SESSION['online']) {
		$url = "$urlName/login.php";
		header("Location: " . $url);
	}

	$_isAdmin = intval($_SESSION['admin']);
	$_isStaff = intval($_SESSION['staff']);
	$db = new DBAccess($conf['db']['dsn'], $conf['db']['user']);
	$pre_url = "$urlName/apartment";
	$floor = 0;
	$addr_no = 0;
	if (!$_isAdmin && !$_isStaff) {
		$addr_no = $_SESSION['addr_no'];
		$floor = $_SESSION['floor'];
	}
	$house_id = 0;
	$house_id = $_GET['id'];
?>
<!-- 內容切換區 -->
<div class="row">
	<div class="col-12 p-4">
		<div class="asset-manage-wrapper">
			<ul class="nav nav-pills mb-3">
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo $pre_url . "/mails.php";?>">郵件紀錄</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/public-util.php";?>">公設預約</a>
				</li>
				<?php
					if ($_isAdmin) {
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/meeting-man.php";?>">會議管理</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/building.php";?>">建築物</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . ".php";?>">基本資料</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="<?php echo $pre_url . "/settings.php";?>">參數設定</a>
                </li>
				<?php
					}
				?>
			</ul>
			<div id="assets-tab">
				<?php
					if ($_isAdmin || $_isStaff) {
				?>
				<a href="<?php echo $urlName;?>/apartment/mails.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增郵件紀錄
				</a>
				<?php
					}
				?>
				<table class="table asset-tableX">
					<thead class="thead-light">
						<tr>
							<th>代碼</th>
							<th>戶號</th>
							<th>樓層</th>
							<!-- <th>住戶狀態</th> -->
							<th>區權人</th>
							<th>現住戶</th>
							<!-- <th>郵件數</th> -->
							<!-- <th>紀錄</th> -->
							<!-- <th>產權</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = 'SELECT house_id,building,addr_no,floor,holder,resident,b.mail_num FROM household a, mails b WHERE b.house_id = a.id AND a.id = ' . $house_id;
							if (!$_isAdmin && !$_isStaff) {
								$addr_no = $_SESSION['addr_no'];
								$floor = $_SESSION['floor'];
								$sql = 'SELECT house_id,building,addr_no,floor,holder,resident,b.mail_num FROM household a, mails b WHERE b.house_id = a.id AND a.addr_no = "' .$addr_no. '" AND a.floor = ' . $floor;
							}
							// echo $sql;
							$data = $db->getRows($sql);
							foreach($data as $var) {
						?>
						<tr>
							<td><span><?php echo $var[building];?></span></td>
							<td><span><?php echo $var[addr_no];?></span></td>
							<td><span><?php echo $var[floor];?></span></td>
							<td><span><?php echo $var[holder];?></span></td>
							<td><span><?php echo $var[resident];?></span></td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>



			<div id="assets-tab">
				<?php
					if ($_isAdmin || $_isStaff) {
				?>
				<!-- <a href="<?php echo $urlName;?>/org/mails-create.php" class="btn add-asset-btn mb-3">
					<span>+</span>新增郵件紀錄
				</a> -->
				<?php
					}
				?>
				<table class="table asset-table">
					<thead class="thead-light">
						<tr>
							<th>日期</th>
							<th>已領件數</th>
							<!-- <th>樓層</th> -->
							<!-- <th>住戶狀態</th> -->
							<!-- <th>區權人</th> -->
							<!-- <th>現住戶</th> -->
							<!-- <th>郵件數</th> -->
							<!-- <th>紀錄</th> -->
							<!-- <th>產權</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = 'SELECT house_id,building,addr_no,floor,holder,resident,b.mail_num FROM household a, mails b WHERE b.house_id = a.id';
							if (!$_isAdmin && !$_isStaff) {
								$addr_no = $_SESSION['addr_no'];
								$floor = $_SESSION['floor'];
								$sql = 'SELECT house_id,building,addr_no,floor,holder,resident,b.mail_num FROM household a, mails b WHERE b.house_id = a.id AND a.addr_no = "' .$addr_no. '" AND a.floor = ' . $floor;
							}
							// echo $sql;
							$sql = 'SELECT COUNT(*) n,dd FROM `mails_log` WHERE house_id = ' . $house_id . ' GROUP BY dd';
							$data = $db->getRows($sql);
							foreach($data as $var) {
						?>
						<tr>
							<!-- <td><span><?php echo $var[building];?></span></td> -->
							<!-- <td><span><?php echo $var[addr_no];?></span></td> -->
							<td><span><?php echo $var[dd];?></span></td>
							<td><span><?php echo $var[n];?></span></td>
							<!-- <td><span><?php echo $var[floor];?></span></td> -->
							<!-- <td><span><?php echo $var[holder];?></span></td> -->
							<!-- <td><span><?php echo $var[resident];?></span></td> -->
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
		"searchPlaceholder": "搜尋日期...",
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
})
$('.mail_num').on('change',function(){
	var _this=$(this);
	$.ajax({
		url:'../data/mailsData.php',
		method:'POST',
		data:{
			id:_this.attr('data-id'),
			mail_num:_this.val()
		},
		success:function(data){
			try{
				var _data=JSON.parse(data);
				if(_data.success){
					console.log(_data.data)
				}else{
					// alert('請重新操作')
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
</script>
<?php include('../Footer.php'); ?>